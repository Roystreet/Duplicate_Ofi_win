<?php

namespace App\Http\Controllers\App\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\TpRol;
use App\User;
use App\Models\User;
use App\Models\RolUsers;
use App\Models\UsersRed;
use App\Models\UsersPasswords;

use Flash;
use Mail;

class RegisterReferredController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($sponsor)
    {
        $recomendado= User::where('id',$sponsor)->first();
       $iduser =  $recomendado->id;
       $nombres =$recomendado->nombres;
       $apellidos  = $recomendado->apellidos;

        //list profiles for select
        $perfiles = TpRol::where('id','<>', 1)->where('id','<>',5)->pluck('descripcion', 'id');

        return view('App.Auth.register_referred',compact('perfiles','iduser','nombres','apellidos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validations
        $request->validate([
            'phone'  => 'required|integer|min:6',
            'email'  => 'required|string|email',
            'perfil' => 'required|integer|'
        ], [
            'phone.required' => 'El Teléfono es obligatorio',
            'phone.integer' => 'El Teléfono debe ser numérico',
            'email.required' => 'El Correo es obligatorio',
            'email.unique' => 'El Correo ingresado ya se encuentra registrado',
            'perfil.required' => 'El Perfil es obligatorio',
            'perfil.integer' => 'El Perfil debe ser numérico',
        ]);


        //this is the user of the sponsor to save
        //$request->usersponsor;


        try{
            DB::beginTransaction();

        // Ensure that they cannot register administrator user
        if($request->perfil == 1 || $request->perfil == 5){
           $perfil = 4;
        }elseif($request->perfil == 2 || $request->perfil == 3 || $request->perfil == 4){
           $perfil = $request->perfil;
        }else{
            $perfil = 4;
         }

        //Function Generate alphanumeric password

            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

            function generate_string($input, $strength = 16) {
            $input_length = strlen($input);
            $random_string = '';
            for($i = 0; $i < $strength; $i++) {
                $random_character = $input[mt_rand(0, $input_length - 1)];
                $random_string .= $random_character;
            }

            return $random_string;
            }

            // Generate 8-digit alphanumeric value
            $alfanumericos = generate_string($permitted_chars, 8);

            // Encrypt alphanumeric password
            $password = Hash::make($alfanumericos);

            // Set lowercase email
            $email = mb_strtolower($request->email);


        //Create user record

        $user = [
            'phone'        =>  $request->phone,
            'email'        =>  $email,
            'name'         =>  'USUARIO App',
            'password'     =>  $password
          ];
        // save record in table User
        $id_user = User::create($user)->id;
            $user_app = [
              'id_user'      =>  $id_user,
              'telefono'     =>  $request->phone,
              'email'        =>  $email,
              'id_status_users_app' => 2

            ];
        // save record in table User
        $id_userApp = User::create($user_app)->id;

        $dataPasswordUserApp = [
            'id_users'     => $id_userApp,
            'password'         => $password,
            'password_repeat'  => $password,
            'status'           => true,
          ];
        // save record in table UsersPasswords
        UsersPasswords::create($dataPasswordUserApp)->id;

        $rol_users = [
            'id_user'      =>  $id_user,
            'id_tp_rol'    =>  5,
            'status'       =>  true

          ];
        // save record in table RolUsers , first record
        $id_rolUsers = RolUsers::create($rol_users)->id;


        $rol_users2 = [
            'id_user'      =>  $id_user,
            'id_tp_rol'    =>  $perfil,
            'status'       =>  true
          ];
        // save record in table RolUsers , second record
        $id_rolUsers2 = RolUsers::create($rol_users2)->id;


        //profile type in text, to send personalized mail
        if($perfil == 2){

            $tipPerfil = 'EMBAJADOR';

        }elseif($perfil == 3){

            $tipPerfil = 'CONDUCTOR';

        }elseif($perfil == 4){

            $tipPerfil = 'PASAJERO';

        }else{

        }

        $s = $email;
        $a = array("contrasenia" => $alfanumericos ,
                   "correo"      => $email ,
                   "perfil"      => $tipPerfil ,
                   "telefono"    => $request->phone);


        Mail::send('App.Auth.user_mail',compact('a'),function($message) use ($s)
        {
          $message->from('no-reply@winhold.net','WIN TECNOLOGIES INC S.A.');
          $message->to($s)->subject('Registro de Usuario en Oficina Virtual');
        });

        DB::commit();
      }catch(\Exception $e){
        DB::rollback();

        // dd($e);

        Flash::error('Hemos encontrado algunos errores.');
        return  redirect()->route('register_app');
      }

      Flash::success('Registrado de forma exitosa, en su correo electrónico le enviamos una contraseña para ingresar a la oficina virtual.');

       //UsersRed::create()->id; "revisar"
       return  redirect()->route('login');
    }

}
