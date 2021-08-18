<?php

namespace App\Http\Controllers\App\Red;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Classes\MenuClass;
use App\Classes\Red;


use App\Models\Views\vw_users_list;
use App\Models\UsersPasswords;
use App\Models\RolUsers;
use App\Models\Country;
use App\Models\Departament;
use App\Models\City;
use App\Models\Distrito;
use App\Models\TokenUsersApp;
use App\Models\RedUsuarios;
use App\User;
use Carbon\Carbon;




class TreeController extends Controller
{
  /** Mostar vista  de resumen de registros */
  function index()
  {
    $main = new MenuClass();
    $main = $main->getMenu();
    $user = vw_users_list::where('id', auth()->user()->id)->first();

    return view('app.red_details.index', compact('main', 'user'));
  }

  //obtiene la informacion basica de una red (no terminado)
  function getData()
  {

    ini_set('memory_limit', '-1');
    ini_set('max_execution_time', 999999);

    $user = vw_users_list::where('id', auth()->user()->id)->first();
    $username;
    if(!$user){
      return response()->json(["object" => "error", "menssage" => "no existe el usuario"]);
    }
    $username = $user->username;
    if(!$username){
      return response()->json(["object" => "error", "menssage" => "Debes completar tu registro."]);
    }

    $red   = new Red();
    $d     = $red->getRedBase($username);
    $level = end($d);


    $fechas_ordenadas   = [];

    foreach ($d as $key => $value) {
      if ($value->created_at == null || $value == null)
        continue;
      $o = new  \stdclass();
      $o->created_at = Carbon::parse($value->created_at)->format('Y-m-d');
      array_push($fechas_ordenadas, $o);
    }

    $date_week_count  = 0;
    $date_mount_count = 0;
    $count_direncta   = 0;
    $count_indirecta  = 0;

    $hoy = Carbon::now();

    foreach ($fechas_ordenadas as $key => $value) {
      if ($hoy->diffInWeeks($value->created_at) == 0) {
        $date_week_count++;
      }

      if ($hoy->diffInMonths($value->created_at) == 0) {
        $date_mount_count++;
      }
    }

    foreach ($d  as $key => $value) {
      if ($value->level == 2) {
        $count_direncta++;
      } elseif ($value->level != 1) {
        $count_indirecta++;
      }
    }

    return response()->json([
      'cantidad'    => count($d), "niveles" => $level->level, 'data' => $d,
      'fecha'       => $fechas_ordenadas, "cantidad_semana" => $date_week_count, "cantidad_mes" => $date_mount_count,
      "red_directa" => $count_direncta, "red_indirecta" => $count_indirecta,
    ]);
  }


  function viewRedCircular()
  {
    $main = new MenuClass();
    $main = $main->getMenu();
    return view('app.red_details.view_circular',  compact('main'));
  }


  //esta funcion va obtener la red con es estructura de un arbol returna un objeto
  function getRed()
  {
    ini_set('memory_limit', '-1');
    ini_set('max_execution_time', 999999);

    $user = vw_users_list::where('id', auth()->user()->id)->first();

    $username;
    if(!$user){
      return response()->json(["object" => "error", "menssage" => "no existe el usuario"]);
    }
    $username = $user->username;

    $limite       = 4; //limite
    $array_color  = []; //array de colores

    for ($i = 0; $i < $limite; $i++) {
      array_push($array_color, $this->color_rand());
    }

    $red = new Red();
    $d   = $red->getRedBase($username);   //obtener la red

    $o   = new  \stdclass();            //crear un objeto lo necesario para la res para red

    $o->name = $d[0]->username;         //descripcion
    $o->nivel = 0;                       //nivel

    if (count($d) != 0) {
      $o->children = $this->recursiveRed($d, $limite, $d[0]->userid, $array_color);
    }
    return response()->json([$o]);
  }


  //funcion para crear la red recursive rebuelve un array de objeto
  // @ $a = el array que tiene toda la red
  // @ $limite = limite de que va entrar a la funcion recursivamente
  // @ $sponsor = es el id del usuario master
  // @ $array_color = el array de colores que se genero en formato hexagesimal
  function recursiveRed($a, $limite = 3, $sponsor = 0, $array_color)
  {
    $limite          = $limite - 1;
    $array_recursive = [];
    $string_color    = $array_color[$limite];


    //busca los invitados de la varible $sponsor
    $auxiliar = array_filter($a, function ($value, $key)  use ($sponsor) {
      if ($value->sponsor_id == $sponsor)
        return true;
    }, ARRAY_FILTER_USE_BOTH);


    //crea el objeto necesario para crear la red
    foreach ($auxiliar as $key => $value) {


      $o = new  \stdclass(); //crear un objeto lo necesario para la res para red
      $o->name  = $value->username; //descripcion
      $o->nivel = $value->level;            //nivel
      $o->color = $string_color;            //color del poin
      if ($limite != 0) {
        $data = $this->recursiveRed($a, $limite, $value->userid, $array_color);
        if (count($data) != 0)
          $o->children = $data;
      }
      array_push($array_recursive, $o);
    }
    return $array_recursive;
  }





  function viewRedClasico ()
  {
    $main = new MenuClass();
    $main = $main->getMenu();
    return view('app.red_details.view_clasico',  compact('main'));
  }


  //esta funcion obtiene la informacion pero se le puede agregar un where a lo que se desea (no terminado)




  //obtiene la data en dormato array de forma optima de una red de un usuario (no terminado)
  function getTableRed()
  {
    $red = new Red();
    return response()->json([$red->getRedBase($usuario)]);
  }






  //genera colores en formato hexadecimal
  function color_rand()
  {
    return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
  }

  //esta funcion se utilizo para ingresar toda la data del excel no tocar
  function  insertData()
  {
    ini_set('max_execution_time', 999999);


    // $dataUserApp = [
    //   'id_tp_sexo'           => null,
    //   'id_country'           =>null,
    //   'id_departament'       => null,
    //   'id_city'              => null,
    //   'nombres'              => mb_strtoupper('Win'),
    //   'apellidos'            => mb_strtoupper('RideShare'),
    //   'f_nacimiento'         =>  null,
    //   'telefono'             => '96582356565',
    //   'email'                => mb_strtolower('support@winrideshare.com'),
    //   'id_status_users_app'  => 2,
    // ];
    // return $id_user_app = User::create($dataUserApp)->id;//63

    // $dataPasswordUserApp = [
    //    'id_users'     => 1610,
    //    'password'         => Hash::make(33226652),
    //    'password_repeat'  => Hash::make(33226652),
    //    'status'           => true,
    //  ];




    //  return UsersPasswords::create($dataPasswordUserApp)->id;

    //       $sponsor_data     = RedUsuarios::where('usuario_invitado', 'winjesus')->first();

    //       $red_usuario_data = [
    //      'id_users_sponsor'    => $sponsor_data->id_users_sponsor,
    //      'id_users_invitado'   => 4,
    //      'codigo_invitado'     => 911855531,
    //      'usuario_invitado'    => mb_strtolower('maiatocas'),
    //      'id_status_red'       => 1
    //    ];
    //   return  RedUsuarios::create($red_usuario_data);


    //   [
    //     "correo"=> "maiatocas8@gmail.com",
    //     "id"=> "8270",
    //     "user"=> "maiatocas",
    //     "User?"=> "Si",
    //     "nombre completo"=> "Mayra Elena ",
    //     "nombre"=> "Mayra Elena",
    //     "apellido"=> "Mamani tocas",
    //     "telefono"=> "944214129",
    //     "direccion"=> "Mayra elena y , Covida 2 Etapa Lima, PE",
    //     "cod_pais"=> "51",
    //     "id_sponsor"=> "3",
    //     "user_sponsor"=> "winjesus"
    // ],
    $data = [];
    return count($data);

    $todo = [];
    foreach ($data as $key => $value) {
      if ($value['User?'] == 'No')
        continue;
      if ($value['user_sponsor'] == "benedic")
        $value['user_sponsor']  = 'jensiinternacional';
      $o = new \stdClass();
      $o->first_name = $value['nombre'];
      $o->last_name = $value['apellido'];
      $o->birthdate = "1993-06-14";
      $o->phone = isset($value['telefono']) ?  $value['telefono'] : '96856565' . $value['id'];
      $o->email = $value['correo'];
      $o->password = '336652';
      $o->sponsor_username = $value['user_sponsor'];
      $o->username = $value['user'];
      $o->user_type = 2;
      $o->id = $value['id'];
      // $this->updatedata($o);
      $dd = $this->insertData_complete($o);
      if ($dd['error']) {
        // break;
        array_push($dd, $o);
        if ($dd['messaje'] == 'no existe el usuario esponsor') {
          break;
        } elseif ($dd['messaje'] == 'no existe el usuario no registrado de user app') {
          break;
        }
      }
    }

    return response()->json($dd);
  }

  function updatedata($input)
  {
    $uu = RedUsuarios::where('usuario_invitado', mb_strtolower($input->username))->first();
    if ($uu) {
      $sponsor_username = $input->sponsor_username;
      $sponsor_data     = vw_users_list::where('username', mb_strtolower($sponsor_username))->first();
      if ($sponsor_data) {
        $uu->id_users_sponsor = $sponsor_data->userid;
        $uu->save();
      }
      // $uu = RedUsuarios::where('usuario_invitado',mb_strtolower($input->username))->first();

    }
  }


  function insertData_complete($input)
  {
    // @Primer Registro: Registro de datos en tabla users app

    if (User::where('email', mb_strtolower($input->email))->exists()) {
      return ['error' => true, 'messaje' => 'ya existe el correo', 'data' => $input];
    } elseif (User::where('telefono', mb_strtolower($input->phone))->exists()) {
      return ['error' => true, 'messaje' => 'ya existe el numero', 'data' => $input];
    } elseif (RedUsuarios::where('usuario_invitado', mb_strtolower($input->username))->exists()) {
      return ['error' => true, 'messaje' => 'ya existe el usuario', 'data' => $input];
    }

    $id_tp_sexo     = null;
    $id_country     = null;
    $id_departament = null;
    $id_city        = null;
    $sponsor_username = $input->sponsor_username;
    $sponsor_data     = vw_users_list::where('username', mb_strtolower($sponsor_username))->first();

    if (!$sponsor_data) {
      return  ['error' => true, 'messaje' => 'no existe el usuario esponsor', 'data' => $input];
    }


    $dataUserApp = [
      'id_tp_sexo'           => $id_tp_sexo,
      'id_country'           => $id_country,
      'id_departament'       => $id_departament,
      'id_city'              => $id_city,
      'nombres'              => mb_strtoupper($input->first_name),
      'apellidos'            => mb_strtoupper($input->last_name),
      'f_nacimiento'         => property_exists($input, 'birthdate') ? $input->birthdate : null,
      'telefono'             => $input->phone,
      'email'                => mb_strtolower($input->email),
      'id_status_users_app'  => 2,
    ];
    $id_user_app = User::create($dataUserApp)->id; //63

    if (!$id_user_app) {
      return  ['error' => true, 'messaje' => 'no existe el usuario no registrado de user app', 'data' => $input];
    }

    // @Segundo Registro: Registro de datos en tabla user
    $dataUser             = [
      'name'              => 'USUARIO EXTERNO',
      'email'             => mb_strtolower($input->email),
      'email_verified_at' => mb_strtolower($input->email),
      'password'          => Hash::make($input->password),
    ];
    $id_user = User::create($dataUser)->id; //63

    // @Tercer Registro: Registro de datos en tabla passwords user



    $dataPasswordUserApp = [
      'id_users'     => $id_user_app,
      'password'         => Hash::make($input->password),
      'password_repeat'  => Hash::make($input->password),
      'status'           => true,
    ];
    UsersPasswords::create($dataPasswordUserApp)->id;

    // @Tercer Registro: Registro en red del usuario
    $codigo_rand   = rand(1000000, 9999999);
    $codigo_final = $codigo_rand . $input->id;


    $red_usuario_data = [
      'id_users_sponsor'    => $sponsor_data->userid,
      'id_users_invitado'   => $id_user_app,
      'codigo_invitado'     => $codigo_final,
      'usuario_invitado'    => mb_strtolower($input->username),
      'id_status_red'       => 1
    ];
    RedUsuarios::create($red_usuario_data);



    $dataUserRol = [
      'id_user'         => $id_user,
      'id_tp_rol'       => $input->user_type,
    ];
    $rolUser = RolUsers::where('id_user', $id_user)->where('id_tp_rol', $input->user_type)->first();
    if (!$rolUser) {
      $rolUser = RolUsers::create($dataUserRol)->id;
    }

    $dataUserRolBasico = [
      'id_user'         => $id_user,
      'id_tp_rol'       => 5,
    ];
    $rolUser2 = RolUsers::where('id_user', $id_user)->where('id_tp_rol', 5)->first();
    if (!$rolUser2) {
      $rolUser2 = RolUsers::create($dataUserRolBasico)->id;
    }

    return ['error' => false];
  }
}
