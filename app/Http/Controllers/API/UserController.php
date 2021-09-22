<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Validator, Redirect, Response, File;

use App\Models\Views\vw_users_list;

use App\Models\UsersPasswords;
use App\Models\RolUsers;
use App\Models\UsersRed;
use App\Models\Country;
use App\Models\Departament;
use App\Models\City;
use App\Models\Distrito;
use App\Models\UsersToken;
use App\User;
use Password;
use Flash;
use Auth;
use Mail;


class UserController
{

    /** @desc: Constructor de variables globales  **/
    public function __construct()
    {
      $this->secret   = config('api_secret.secret');
      $this->url      = config('api_secret.url');
      $this->api_app  = config('api_secret.api_app');


    }

    /** @funcion: Obtenemos variable de expires & signature, para el url de get user en OV.    **/
    public function generateURLSignature($action)
    {
        $url    = $this->url.'/'.$this->api_app.'/'.$action;
        $secret = $this->secret;

        $expired = time() + 800;
        $url .= '?expires=' . $expired;

        $signature = hash_hmac('sha256', $url, $secret, false);
        // dump($expired);
        // dump($signature);

        return $url . '&signature=' . $signature;
    }

    /** @funcion: Obtenemos variable de expires & signature, para ser validadas.    **/
    public function verifyURLSignature($request)
    {

      //Validando Firmas
      $signature   = $request->input('signature');
      $expire_time = $request->input('expires');

      // Get accurate URL according to request-- Must match signed URL exactly!
      $srv_proto = explode('/', $_SERVER['SERVER_PROTOCOL']);
      $protocol  = ($srv_proto[1] == "HTTPS") ? "https://" : "http://";

      $verifyURL = $protocol . $_SERVER['SERVER_NAME'] . strstr( $_SERVER['REQUEST_URI'], "&signature=", true );

      // Verify inbound signature
      $verify_signature = hash_hmac('sha256', $verifyURL, $this->secret, false);
      // //temporal
      // return true;

      if ($signature != $verify_signature)
      return false;

      return (time() < $expire_time);
    }

    public function user_create(Request $request)
    {

      $validUri    = $this->verifyURLSignature($request);
      if(!$validUri){
        return Response::json(array(
            'status' => 400,
            'data'   => [
                'posts'=> [
                    'Error' => 'Invalid signature or expires time',
                    ]
                ]
        ), 400);
      }

      $input = (object) $request->all();

      // @EVALUACION
      /*Valido Sponsor Name **/
      $sponsor_username = $input->sponsor_username;
      $sponsor_data     = vw_users_list::where('username', $sponsor_username)->first();

      $validDato = (object) $this->validSponsorName($sponsor_username);
      if ($validDato->status == 490){
        return Response::json(array(
            'status' => $validDato->status,
            'data'   => [
                'posts'=> [
                    'Error' => $validDato->Error,
                    'Code'  => $validDato->Code,
                    ]
                    ]
                ), $validDato->status );
      }

      if(isset($input->username))   {
        $validDato = (object) $this->validUsername   ($input->username);
        if ($validDato->status == 490){
          return Response::json(array(
            'status' => $validDato->status,
            'data'   => [
              'posts'=> [
                'Error' => $validDato->Error,
                'Code'  => $validDato->Code,
                ]
                ]
              ), $validDato->status );
        }
      }

      $validDato = (object) $this->validEmail($input->email);
      if ($validDato->status == 490){
          return Response::json(array(
              'status' => $validDato->status,
              'data'   => [
                  'posts'=> [
                      'Error' => $validDato->Error,
                      'Code'  => $validDato->Code,
                      ]
                      ]
                  ), $validDato->status );
      }


      $validDato = (object) $this->validPhone($input->phone_base);
      if ($validDato->status == 490){
          return Response::json(array(
              'status' => $validDato->status,
              'data'   => [
                  'posts'=> [
                      'Error' => $validDato->Error,
                      'Code'  => $validDato->Code,
                      ]
                      ]
                  ), $validDato->status );
              }

      // @EVALUACION
      /*Valido campos basicos requeridos **/
      $validatorName = Validator::make($request->all(), [
          'sponsor_username' =>  'required',
          // 'username'         =>  'required',
          'first_name'       =>  'required',
          'last_name'        =>  'required',
          'phone_base'       =>  'required',
          'phone_country'    =>  'required',
          'phone_number'     =>  'required',
          'email'            =>  'required',
          'password'         =>  'required',
          'user_type'        =>  'required',
          'birth'            =>  'date',
      ]);

      if ($validatorName->fails()) {
          $errors = [];
          foreach($validatorName->getMessageBag()->toArray() as $key=>$messages) {
              $errors[$key] = $messages[0];
          }
        return Response::json(array(
          'status' => 490,
          'data'   => [
              'posts'=> [
                  'Error' => '(5101) missing field',
                  'Data'  => $errors,
                  'Code'  => 5101,
                  ]
              ]
          ), 490); // 400 being the HTTP code for an invalid request.
      }
      /*Valido campos basicos requeridos **/


      try{
        DB::beginTransaction();

          // @Primer Registro: Registro de datos en tabla users
          $id_tp_sexo     = property_exists ($input, 'gender')             ? $this->getTpSexo     ($input->gender)                         : null;
          $id_country     = property_exists ($input, 'address_country')    ? $this->getCountry    ($input->address_country)                : null;
          $id_departament = property_exists ($input, 'state_or_province')  ? $this->getDepartament($input->state_or_province, $id_country) : null;
          $id_city        = property_exists ($input, 'address_city')       ? $this->getCity       ($input->address_city, $id_departament)  : null;


          $dataUserApp = [
            'id_tp_sexo'           => $id_tp_sexo,
            'id_country'           => $id_country,
            'id_departament'       => $id_departament,
            'id_city'              => $id_city,
            'first_name'           => mb_strtoupper($input->first_name),
            'middle_name'          => isset($input->middle_name) ? mb_strtoupper($input->middle_name) : null,
            'last_name'            => mb_strtoupper($request->last_name),
            'birth'                => property_exists ($input, 'birth')? $input->birth : null,
            'phone'                => $input->phone_base,
            'address'              => isset($input->address_address1) ? $input->address_address1 : null,
            'email'                => mb_strtolower($input->email),
            'n_document'           => property_exists ($input, 'document_number')? $input->document_number : null,
            'id_tp_document'       => null,
            'id_status_users_app'  => 2,
          ];
          $id_user = User::create($dataUserApp)->id;

          // @Segundo Registro: Registro de datos en tabla passwords user
          $dataPasswordUserApp = [
            'id_users'         => $id_user,
            'password'         => Hash::make($input->password),
            'password_repeat'  => Hash::make($input->password),
            'status'           => true,
          ];
          UsersPasswords::create($dataPasswordUserApp)->id;

          // @Tercer Registro: Registro en red del usuario
          $usernameCreate = mb_strtolower(substr($input->first_name, 0, 2).substr($input->last_name, 0, 2)).rand(100000,999999);
          $username       = (property_exists ($input, 'username')? mb_strtolower($input->username) : $usernameCreate);

          $red_usuario_data = [
            'id_users_sponsor'    => $sponsor_data->userid,
            'id_users'   => $id_user,
            'username'    => $username,
            'id_status_red'       => 1
          ];
          UsersRed::create($red_usuario_data);

          // Rol Pasaero para todos Rol 3
          $dataUserRol = [
            'id_user'         => $id_user,
            'id_tp_rol'       => 3//$input->user_type,
          ];
          $rolUser = RolUsers::where('id_user', $id_user)->where('id_tp_rol',$input->user_type)->first();
          if(!$rolUser){
            $rolUser = RolUsers::create($dataUserRol)->id;
          }

          $dataUserRolBasico = [
            'id_user'         => $id_user,
            'id_tp_rol'       => 5,
          ];
          $rolUser2 = RolUsers::where('id_user', $id_user)->where('id_tp_rol', 5)->first();
          if(!$rolUser2){
            $rolUser2 = RolUsers::create($dataUserRolBasico)->id;
          }

          DB::commit();
          }
            catch(\Exception $e){
              dump($e);
              die();
              DB::rollback();
              return Response::json(array(
                'status' => 490,
                'data'   => [
                    'posts'=> [
                        'Error' => $e,
                        ]
                    ]
                ), 490); // 400 being the HTTP code for an invalid request.
            }

        /** @desciption:
        * Incluir acá el envio de correo electronico
        */
        $first_name = $input->first_name.' '.$request->last_name;

        $a = array('name'=>$first_name);
        $s = $input->email;



        Mail::send('emails.new_register',$a,function($message) use ($s)
        {
          $message->from('no-reply@winhold.net','WIN RIDESHARE');
          $message->to($s)->subject('ESTAS POR FINALIZAR TU REGISTRO EN WIN ¡COMPLETA TU PERFIL!');
        });

        return Response::json(array(
            'status' => 200,
            'data'   => [
                'posts'=> [
                    'username' => $username,
                    'userid'   => $id_user,
                ]
            ]
        ), 200); // 400 being the HTTP code for an invalid request.



    }

    public function user_usernameCheck(Request $request)
    {
      $validUri    = $this->verifyURLSignature($request);
      if(!$validUri){
        return Response::json(array(
            'status' => 400,
            'data'   => [
                'posts'=> [
                    'Error' => 'Invalid signature or expires time',
                    ]
                ]
        ), 400);
      }


        $input = (object) $request->all();
        // @EVALUACION
        /*Valido User Name **/
        $validatorName = Validator::make(array('username' => $input->username), [
            'username'   =>  'required|max:15|min:4|unique:users_red,username,NULL,id',
        ]);
        if ($validatorName->fails()) {

            return Response::json(array(
                'status' => 490,
                'data'   => [
                    'posts'=> [
                        'Error' => 'user not available',
                    ]
                ]
            ), 490);
        }else {
            return Response::json(array(
                'status' => 200,
            ), 200);
        }
        /*Valido User Name **/


    }

    public function user_get(Request $request)
    {

      $validUri    = $this->verifyURLSignature($request);
      if(!$validUri){
        return Response::json(array(
            'status' => 400,
            'data'   => [
                'posts'=> [
                    'Error' => 'Invalid signature or expires time',
                    ]
                ]
        ), 400);
      }


        $input = (object) $request->all();
        $passenger = 0; $driver = 0; $ambassador = 0;


        if(property_exists ($input, 'userid')   ){
          if (!is_numeric($input->userid)) {
            return Response::json(array(
                  'status' => 490,
                  'data'   => [
                      'posts'=> [
                          'Error' => 'does not exist',
                      ]
                  ]
              ), 490 );
           }
            $userData = vw_users_list::where('userid',   $input->userid)->first();
        }
        if(property_exists ($input, 'username') ){
            $userData = vw_users_list::where('username', $input->username)->first();
        }

        if($userData){


            $user  = User::where    ('email',   $userData->public_email)->first();
            $roles = RolUsers::where('id_user', $user->id   )->get();

            foreach ($roles as $key) {
                if( $key->id_tp_rol == 2 ){
                    $ambassador = 1;
                }
                if( $key->id_tp_rol == 4 ){
                    $driver = 1;
                }
                if( $key->id_tp_rol == 3 ){
                    $passenger = 1;
                }
            }

            $sponsor    = vw_users_list::where('userid',   $userData->sponsor_id)->first();

            return Response::json(array(
                'status' => 200,
                'data'   => [
                    'posts'=> [
                        'profile' => $userData,
                        'sponsor' => $sponsor,
                        'details' => [
                            'passenger'  => $passenger,
                            'driver'     => $driver,
                            'ambassador' => $ambassador,
                            ]
                    ]
                ]
            ), 200 );


        }
        else{
          return Response::json(array(
                'status' => 490,
                'data'   => [
                    'posts'=> [
                        'Error' => 'does not exist',
                    ]
                ]
            ), 490 );
        }



    }

    public function user_sponsorCheck(Request $request)
    {
      $validUri    = $this->verifyURLSignature($request);
      if(!$validUri){
        return Response::json(array(
            'status' => 400,
            'data'   => [
                'posts'=> [
                    'Error' => 'Invalid signature or expires time',
                    ]
                ]
        ), 400);
      }

        $input = (object) $request->all();
        // @EVALUACION
        /*Valido User Name **/
        $validatorName = Validator::make(array('username' => $input->username), [
            'username'   =>  'required|max:15|min:4|unique:users_red,username,NULL,id',
        ]);
        if ($validatorName->fails()) {
            return Response::json(array(
                'status' => 200,
            ), 200);

        }else {
            return Response::json(array(
                'status' => 490,
                'data'   => [
                    'posts'=> [
                        'Error' => 'user not available',
                        ]
                        ]
                    ), 490);
        }
        /*Valido User Name **/
    }

    public function user_emailCheck(Request $request)
    {
      $validUri    = $this->verifyURLSignature($request);
      if(!$validUri){
        return Response::json(array(
            'status' => 400,
            'data'   => [
                'posts'=> [
                    'Error' => 'Invalid signature or expires time',
                    ]
                ]
        ), 400);
      }

        $input = (object) $request->all();
        // @EVALUACION
        /*Valido User Name **/
        $validatorName = Validator::make(array('email' => $input->email), [
            'email'   =>  'required|email|unique:users,email,NULL,id',
        ],
        [
          'email.unique' => 'Email already exists',
          'email.required' => 'Email address has an empty value',

        ]
        );
        if ($validatorName->fails()) {
            $errors = [];
            foreach($validatorName->getMessageBag()->toArray() as $key=>$messages) {
                $errors[$key] = $messages[0];
            }
            return Response::json(array(
                'status' => 490 ,
                'data'   => [
                    'posts'=> [
                            'Error' => $errors{'email'},
                            ]
                        ]
                    ), 490 );
        }else {
            return Response::json(array(
                'status' => 200,
            ), 200);
        }
        /*Valido User Name **/
    }

    public function user_phoneCheck(Request $request)
    {
      $validUri    = $this->verifyURLSignature($request);
      if(!$validUri){
        return Response::json(array(
            'status' => 400,
            'data'   => [
                'posts'=> [
                    'Error' => 'Invalid signature or expires time',
                    ]
                ]
        ), 400);
      }

        $input = (object) $request->all();
        // @EVALUACION
        /*Valido User Name **/
        $validatorName = Validator::make(array('phone' => $input->phone_number), [
            'phone'   =>  'required|unique:vw_users_list,public_phone,NULL,id',
        ],
        [
          'phone.unique' => 'Phone already exists',
          'phone.required' => 'Phone has an empty value',

        ]);
        if ($validatorName->fails()) {
            $errors = [];
            foreach($validatorName->getMessageBag()->toArray() as $key=>$messages) {
                $errors[$key] = $messages[0];
            }
            return Response::json(array(
                'status' => 490 ,
                'data'   => [
                    'posts'=> [
                            'Error' => $errors{'phone'},
                            ]
                        ]
                    ), 490 );
        }else {
            return Response::json(array(
                'status' => 200,
            ), 200);
        }
        /*Valido User Name **/
    }

    public function user_update(Request $request)
    {
      $validUri    = $this->verifyURLSignature($request);
      if(!$validUri){
        return Response::json(array(
            'status' => 400,
            'data'   => [
                'posts'=> [
                    'Error' => 'Invalid signature or expires time',
                    ]
                ]
        ), 400);
      }

        $input = (object) $request->all();

        $userData = null;
        $validDato{'status'} = 200;

        if(isset ($input->userid) ){
          if (!is_numeric($input->userid)) {
            return Response::json(array(
                  'status' => 490,
                  'data'   => [
                      'posts'=> [
                          'Error' => 'does not exist',
                      ]
                  ]
              ), 490 );
           }
           $userData = vw_users_list::where('userid', $input->userid)->first();
        }
        if(isset ($input->username) ){
            $userData = vw_users_list::where('username',       $input->username)->first();
        }


        if(!$userData){
            return Response::json(array(
                'status' => 490,
                'data'   => [
                    'posts'=> [
                      'Error' => 'does not exist',
                    ]
                ]
            ), 490 );
        }
        else{


            if(property_exists ($input, 'new_username') ){
              $validDato1 = $this->validUsername($input->new_username);
              if ($validDato1{'status'} == 490){
                  return Response::json(array(
                      'status' => $validDato1{'status'},
                      'data'   => [
                          'posts'=> [
                              'Error' => $validDato1{'Error'},
                              'Code'  => $validDato1{'Code'},
                              ]
                              ]
                          ), $validDato1{'status'} );
              }
            }
            if(property_exists ($input, 'email') )       {
              $validDato2 = $this->validEmail   ($input->email);
              if ($validDato2{'status'} == 490){
                  return Response::json(array(
                      'status' => $validDato2{'status'},
                      'data'   => [
                          'posts'=> [
                              'Error' => $validDato2{'Error'},
                              'Code'  => $validDato2{'Code'},
                              ]
                              ]
                          ), $validDato2{'status'} );
              }
            }
            if(property_exists ($input, 'phone') )       {
              $validDato3 = $this->validPhone   ($input->phone);
              if ($validDato3{'status'} == 490){
                  return Response::json(array(
                      'status' => $validDato3{'status'},
                      'data'   => [
                          'posts'=> [
                              'Error' => $validDato3{'Error'},
                              'Code'  => $validDato3{'Code'},
                              ]
                              ]
                          ), $validDato3{'status'} );
              }
            }

            try{
              DB::beginTransaction();
                // @Primer Registro: Registro de datos en tabla users app
                $dataUserApp = [
                  'first_name'      => property_exists ($input, 'first_name')   ?  mb_strtoupper($input->first_name)        : $userData->first_name,
                  'middle_name'     => property_exists ($input, 'middle_name')  ?  mb_strtoupper($request->middle_name )    : $userData->middle_name,
                  'last_name'       => property_exists ($input, 'last_name' )   ?  mb_strtoupper($request->last_name )      : $userData->last_name,
                  'phone'           => property_exists ($input, 'phone_base')   ?  $input->phone_base                       : $userData->phone_base,
                  'email'           => property_exists ($input, 'email')        ?  mb_strtolower($input->email)             : $userData->public_email,
                  'birth'           => property_exists ($input, 'birth')        ?       $input->birth : $userData->birth,
                  'address'         => property_exists ($input, 'address_address1')?    $input->address_address1 : $userData->address_1,
                  'n_document'      => property_exists ($input, 'document_number')?     $input->n_document  : $userData->n_document,
                ];
                $userApps = User::find($userData->userid);
                $userApps->update($dataUserApp);


                // @Segundo Registro: Registro de datos en tabla passwords user
                if(isset ($input->password) ){

                    $dataUser['password'] =  Hash::make($input->password);

                    $user = User::where('id', mb_strtolower($userData->userid))->first();
                    $user->update($dataUser);

                    $dataPasswordUserApp = [
                        'id_users'         => $userData->userid,
                        'password'         => Hash::make($input->password),
                        'password_repeat'  => Hash::make($input->password),
                        'status'           => true,
                    ];
                    $PasswordUsersAppUpd   = UsersPasswords::where('id_users', $userData->userid)->update(array('status' => 0));
                    UsersPasswords::create($dataPasswordUserApp)->id;
                }


                // @Tercero Registro: Registro de datos en tabla red usuarios
                if(property_exists ($input, 'new_username')){
                    $red_usuario_data = [
                      'id_users'   => $userData->userid,
                      'username'    => mb_strtolower($input->new_username),
                    ];
                    $redUsuarios = UsersRed::where('id_users', $userData->userid)->first();
                    $redUsuarios->update($red_usuario_data);
                }

                DB::commit();
            }
            catch(\Exception $e){
              DB::rollback();
              return Response::json(array(
                'status' => 490,
                'data'   => [
                    'posts'=> [
                        'Error' => $e,
                        ]
                    ]
                ), 490); // 400 being the HTTP code for an invalid request.
            }

        }//Fin de else

        $redUsuarios = UsersRed::where('id_users', $userData->userid)->first();

        return Response::json(array(
            'status' => 200,
            'data'   => [
                'posts'=> [
                    'username' => mb_strtolower($redUsuarios->username),
                    'userid'   => $userData->userid,
                ]
            ]
        ), 200); // 400 being the HTTP code for an invalid request.



    }

    public function user_passwordReset(Request $request)
    {
      $validUri    = $this->verifyURLSignature($request);
      if(!$validUri){
        return Response::json(array(
            'status' => 400,
            'data'   => [
                'posts'=> [
                    'Error' => 'Invalid signature or expires time',
                    ]
                ]
        ), 400);
      }

      $userData = null;
      $input = (object) $request->all();
      if(property_exists ($input, 'userid')   ){
        if (!is_numeric($input->userid)) {
          return Response::json(array(
                'status' => 490,
                'data'   => [
                    'posts'=> [
                        'Error' => 'does not exist',
                    ]
                ]
            ), 490 );
         }
        $userData = vw_users_list::where('userid',   $input->userid)->first();
      }

        if(!$userData){
            return Response::json(array(
                'status' => 470 ,
                'data'   => [
                    'posts'=> [
                        'Error' => 'Invalid userid',
                    ]
                ]
            ), 490 );
        }else {
            $email = $userData->email;
            $name  = $userData->last_name.' '.$userData->first_name;

            $respuesta =  $this->sendEmail($email,$name);

            return Response::json(array(
                'status' => 200 ,
                'data'   => [
                    'posts'=> [
                        'email_sent' => '1',
                    ]
                ]
            ), 200 );
        }




    }

    public function user_authenticate(Request $request)
    {
      $validUri    = $this->verifyURLSignature($request);
      if(!$validUri){
        return Response::json(array(
            'status' => 400,
            'data'   => [
                'posts'=> [
                    'Error' => 'Invalid signature or expires time',
                    ]
                ]
        ), 400);
      }

      if(!isset($request->password)){
        return Response::json(array(
          'status' => 400 ,
          'data'   => [
            'posts'=> [
              'Error' => 'Invalid Login (password mismatch)',
              'Code'  => '10'
              ]
              ]
            ), 400 );
          }

          if(!isset($request->username)){
            return Response::json(array(
              'status' => 400 ,
              'data'   => [
                'posts'=> [
                  'Error' => 'Invalid Login (username mismatch)',
                  'Code'  => '9'
                  ]
                  ]
                ), 400 );
          }



        if (!filter_var($request->username, FILTER_VALIDATE_EMAIL)) {
            $userData           = vw_users_list::where('username',   $request->username)->first();
            $request['email']   = $userData->public_email;
        }
        unset($request['username']);


        $credentials    = $request->validate([
          'email'       => 'required|string',
          'password'    => 'required|string',
        ],
        [
          'email.required'        => 'Invalid Login (username mismatch)',
          'password.required'     => 'Invalid Login (password mismatch)',
        ]);



        if(Auth::attempt($credentials)){


            if (auth()->user()->isexterno != true){
              Auth ::logout();
              return Response::json(array(
                  'status' => 400 ,
                  'data'   => [
                      'posts'=> [
                              'Error' =>'Invalid Session',
                              'Code'  => '4'
                              ]
                          ]
                      ), 400 );
            }
            else {
                $statusUser = User::where('email',auth()->user()->email)->first();
                if($statusUser->id_status_users_app == 3){
                    Auth ::logout();
                    return Response::json(array(
                        'status' => 400 ,
                        'data'   => [
                            'posts'=> [
                                    'Error' =>'Account Inactive',
                                    'Code'  => '12'
                                    ]
                                ]
                            ), 400 );
                }
                elseif ($statusUser->id_status_users_app == 1) {
                  // code...
                  $date1 = new \DateTime($statusUser->updated_at);
                  $date2 = new \DateTime("now");
                  $diff  = $date1->diff($date2);

                  if($diff->days > 3){
                    $statusUser->id_status_users_app = 3;
                    $statusUser->update();
                    Auth ::logout();
                    return Response::json(array(
                        'status' => 400 ,
                        'data'   => [
                            'posts'=> [
                                    'Error' =>'Account Inactive',
                                    'Code'  => '12'
                                    ]
                                ]
                            ), 400 );

                  }

                }

            }

            return Response::json(array(
                'status' => 200,
                'data'    => [
                    'posts'=> [
                                "success" =>  "1",
                                "userid"  =>  $statusUser->id,
                             ]
                        ]
            ), 200);
        }
        else {
            return Response::json(array(
                'status' => 490 ,
                'data'   => [
                    'posts'=> [
                            'Error' => 'Invalid Session',
                            'Code'  => '4'
                            ]
                        ]
                    ), 490 );

        }
    }

    public function user_balanceCheck()
    {
      $validUri    = $this->verifyURLSignature($request);
      if(!$validUri){
        return Response::json(array(
            'status' => 400,
            'data'   => [
                'posts'=> [
                    'Error' => 'Invalid signature or expires time',
                    ]
                ]
        ), 400);
      }


        $input    = (object) $request->all();
        $userData = null;

        if(property_exists ($input, 'userid')   ){
            $userData = vw_users_list::where('userid',   $input->userid)->first();
        }
        if(!$userData){
            return Response::json(array(
                'status' => 490,
                'data'   => [
                    'posts'=> [
                        'Error' => 'does not exist',
                    ]
                ]
            ), 490 );
        }
        if(property_exists ($input, 'currency_id')   ){

            /* @desciption: Este response es temporal debemos cambiar y agregar esta tabla de creditos
            * ALERTA
            */

            return Response::json(array(
                'status' => 200,
                'data'   => [
                    'posts'=> [
                        'balance'         => 0.0 ,
                        'currency_id'     => $input->currency_id,
                        'name'            => "US Dollar",
                        'code'            => "USD",
                        'symbol'          => "$",
                        'amount_formatted'=> "$0.0",
                    ]
                ]
            ), 200 );
        }
        else{
            /* @desciption: Este response es temporal debemos cambiar y agregar esta tabla de creditos
            * ALERTA
            */

            return Response::json(array(
                'status' => 200,
                'data'   => [
                    'posts'=> [
                        'currencies' => [

                            [
                                'balance'         => 0.0 ,
                                'currency_id'     => 1,
                                'name'            => "US Dollar",
                                'code'            => "USD",
                                'symbol'          => "$",
                                'amount_formatted'=> "$0.0"
                            ],
                            [
                                'balance'         => 0.0 ,
                                'currency_id'     => 2,
                                'name'            => "US Dollar",
                                'code'            => "USD",
                                'symbol'          => "$",
                                'amount_formatted'=> "$0.0"
                            ],
                        ]
                    ]
                ]
            ), 200 );

        }

    }

    public function user_balanceUpdate(Request $request)
    {
      $validUri    = $this->verifyURLSignature($request);
      if(!$validUri){
        return Response::json(array(
            'status' => 400,
            'data'   => [
                'posts'=> [
                    'Error' => 'Invalid signature or expires time',
                    ]
                ]
        ), 400);
      }

        $input    = (object) $request->all();
        $userData = null;

        if(property_exists ($input, 'userid')   ){
            $userData = vw_users_list::where('userid',   $input->userid)->first();
        }
        if(!$userData){
            return Response::json(array(
                'status' => 490,
                'data'   => [
                    'posts'=> [
                        'Error' => 'does not exist',
                    ]
                ]
            ), 490 );
        }
        //Deposit
        if($input->type == 1){
            return Response::json(array(
                'status' => 200,
            ), 200);
        }
        //withdraw
        if($input->type == 2){
            return Response::json(array(
                'status' => 200,
            ), 200);
        }



    }

    /**
    *
    * Get Generales
    *
    **/
    public function getTpSexo     ($dato)
    {
        $id_tp_sexo = mb_strtoupper($dato);
        $id_tp_sexo = ($id_tp_sexo == 'F') ? 1 : ($id_tp_sexo == 'M') ? 2 : null;
        return $id_tp_sexo;
    }

    public function getCountry    ($dato)
    {
        $country    = Country::where('code_country', mb_strtoupper($dato))->first();
        $id_country = ($country) ? $country->id : null;
        return $id_country;
    }

    public function getDepartament($dato, $dato2)
    {

        if($dato2 != null){
            $departament = Departament::where( 'code', mb_strtoupper($dato) )->where('id_country',$dato2 )->first();
        }else {
            $departament = Departament::where( 'code', mb_strtoupper($dato) )->first();
        }

        $id_departament = ($departament) ? $departament->id : null;

        return $id_departament;
    }

    public function getCity       ($dato, $dato2)
    {
        if($dato2 != null){
            $city = City::where( 'code', mb_strtoupper($dato) )->where('id_departament', $dato2 )->first();
        }else {
            $city = City::where( 'code', mb_strtoupper($dato) )->first();
        }

        $id_city = ($city) ? $city->id : null;

        return $id_city;
    }

    /**
    *
    * ENVIO DE EMAIL RESET PASSWORD
    *
    **/
    public function sendEmail($dato,$name)
    {
      $token      = str_random(10);

      $datosToken = [
        'id_tp_token' => 2,
        'token_llave' => $dato,
        'token_code'  => $token,
        'status'      => true
      ];

      $queryToken = UsersToken::where('token_llave', $dato)->where('id_tp_token',2)->update(array('id_tp_token' => 4));
                    UsersToken::create($datosToken);

      // Send mail with link to restore in 60 minutes.
      $link = Password::sendResetLink(
        ["email" => $dato]
      );

      return true;

    }

    /**
    *
    * VALIDACIONES
    *
    **/
    public function validSponsorName ($sponsor_username)
    {
        $sponsor_data     = UsersRed::where('username', $sponsor_username)->first();
        if(!$sponsor_data){
            $response['Code']    = 5404;
            $response['Error']   = '(5404) Invalid sponsor, '.$sponsor_username;
            $response['status']  = 490;
        }else{
            $response['status']  = 200;
        }
        return $response;
    }

    public function validUsername    ($username)
    {
        $validatorName = Validator::make(array('username' => $username), [
          'username'   =>  'required|max:15|min:4|unique:users_red,username,NULL,id',
        ],
        [
          'username.unique' => 'duplicate entry if field is required to be unique'
        ]);
        if ($validatorName->fails()) {

            $response['Code']    = 60000;
            $response['Error']   = 'bad username or no username provided';
            $response['status']  = 490;

        }
        else{
            $response['status']  = 200;
        }
        return $response;
    }

    public function validEmail       ($email)
    {
        $validatorName = Validator::make(array('email' => $email), [
          'email'   =>  'required|email|unique:users,email,NULL,id',
        ]);
        if ($validatorName->fails()) {
            $errors = [];
            foreach($validatorName->getMessageBag()->toArray() as $key=>$messages) {
                $errors[$key] = $messages[0];
            }
            $response['Code']    = 5201;
            $response['Error']   = '(5201) invalid email address (email validation failed)';
            $response['status']  = 490;
        }
        else{
            $response['status']  = 200;
        }
        return $response;

    }

    public function validPhone       ($phone)
    {
        $validatorName = Validator::make(array('phone' => $phone), [
          'phone'   =>  'required|unique:vw_users_list,phone_number,NULL,id',
        ]);
        if ($validatorName->fails()) {
            $errors = [];
            foreach($validatorName->getMessageBag()->toArray() as $key=>$messages) {
                $errors[$key] = $messages[0];
            }
            $response['Code']    = 5406;
            $response['Error']   = '(5406) duplicate phone is required to be unique';
            $response['status']  = 490;

        }
        else{
            $response['status']  = 200;
        }
        return $response;
    }
}
