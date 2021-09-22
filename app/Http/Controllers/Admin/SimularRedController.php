<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Models\UsersRed;
use App\Models\RolUsers;
use App\Models\User;
use App\Models\RolMenu;
use App\Models\Country;
use App\Models\Session;
use App\User;
use Auth;
use Flash;
use Response;

use App\Classes\MenuClass;
use App\Models\Menu;



class SimularRedController extends AppBaseController
{
  public function validPermisoMenu($id_menu) {

    $roles = RolUsers::where('id_user', auth()->user()->id)->get();
    foreach ($roles as $key) {
      if($key->id_tp_rol == 1){
        return true;
      }
      else{
        $menu = RolMenu::where('id_tp_rol', $key->id_tp_rol)->where('id_menu', $id_menu)->first();

        if($menu){
          return true;
        }
      }
    }
    return false;

  }

  public function simularRed() {

    $main = new MenuClass();
    $main = $main->getMenu();

    $valor = $this->validPermisoMenu(37);
    if ($valor == false){
      return view('errors.403', compact('main'));
    }


    $filtros= [
      'username'  => 'Usuario',
    ];

    return view('admin.simular_red.index')
    ->with('main',   $main)
    ->with('filtros',   $filtros);

  }

  //ESTO ES PARA SOLO BUSCAR ENTRE TODOS LOS USUARIOS DEPENDIENTES DE MI RED
  public function busquedaUsuarioRed()
  {
    $mensaje = 'No hemos encontrado su búsqueda';
    $flag    = false;

    $campodeBusqueda = request()->campodeBusqueda;
    $campo           = request()->campo;

    $existe = UsersRed::where($campodeBusqueda, $campo)->first();
    if(!$existe){
      return response()->json([
        'data'     => null,
        'flag'     => $flag,
        'mensaje'  => $mensaje,
      ]);
    }else{
      $busquedaFinal = $this->getDataPerfil($existe->id_users);
      return response()->json([
        'data'     => $busquedaFinal,
        'flag'     => true,
        'mensaje'  => "Hemos encontrado su búsqueda",
      ]);
    }




  }

public function simulandoRed($id)
{
  $main = new MenuClass();
  $main = $main->getMenu();

  $valor = $this->validPermisoMenu(37);
  if ($valor == false){
    return view('errors.403', compact('main'));
  }

  $id_sponsor   = $id;
  $dataUser     = User::find($id);
  $user         = User::where('email', $dataUser->email)->first();
  $rolUser      = RolUsers::where('id_user', $user->id)->where('id_tp_rol', '!=', 5)->with('getTpRol')->first();

  if($rolUser){
    $dataUser{'id_tp_rol'} = $rolUser->id_tp_rol;
    $dataUser{'tp_rol'}    = $rolUser->getTpRol->descripcion;

  }
  else {
    $dataUser{'id_tp_rol'} = null;
    $dataUser{'tp_rol'}    = $rolUser->getTpRol->descripcion;
  }
  $filtros= [
    'username'  => 'Usuario',
  ];

  return view('externo.red_detalles.show')
    ->with('main',      $main)
    ->with('rol',       $rolUser)
    ->with('filtros',   $filtros)
    ->with('dataUser',  $dataUser)
    ->with('sponsor',   $id_sponsor)
    ->with('main',   $main);

}



  //DATA COMPLETA DE Perfil
  public function getDataPerfil($id)
  {
    $usersApp = User::find($id);
    $dataUser = [
      "id"             => $usersApp->id,

      "id_country"     => ($usersApp->id_country)?     $usersApp->id_country              : null,
      "country"        => ($usersApp->id_country)?     $usersApp->getCountry->country     : '-',

      "id_departament"     => ($usersApp->id_departament)? $usersApp->id_departament                  : '-',
      "departament"        => ($usersApp->id_departament)? $usersApp->getDepartament->departament     : '-',

      "id_city"     => ($usersApp->id_city)? $usersApp->id_city                  : '-',
      "city"        => ($usersApp->id_city)? $usersApp->getCity->city     : '-',

      "id_tp_sexo"     => ($usersApp->id_tp_sexo)?     $usersApp->id_tp_sexo      : '-',
      "sexo"           => ($usersApp->id_tp_sexo)?     $usersApp->getSexo->descripcion     : '-',

      "nombres"        => ($usersApp->nombres)?        $usersApp->nombres     : null,
      "apellidos"      => ($usersApp->apellidos)?      $usersApp->apellidos   : null,
      "f_nacimiento"   => ($usersApp->f_nacimiento)?   $usersApp->f_nacimiento->format('Y-m-d') : '-',
      "phone"       => ($usersApp->phone)?       $usersApp->phone    : null,
      "email"          => ($usersApp->email)?          $usersApp->email    : '-',
      "created_at"     => ($usersApp->created_at)?     $usersApp->created_at->format('d-m-Y') : '-',

      "id_status_users_app" => ($usersApp->id_status_users_app)?  $usersApp->id_status_users_app : '-',
      "status_users_app"    => ($usersApp->id_status_users_app)?  $usersApp->getStatusUsersApp->status_users_app : '-',
    ];

    $datosSessionAnt = Session::where('token', auth()->user()->email)->where('id_status_session', 2)->orderby('updated_at','DESC')->first();
    if($datosSessionAnt){
      $date1 = new \DateTime($datosSessionAnt->updated_at);
      $date2 = new \DateTime("now");
      $diff = $date1->diff($date2);
      $dataUser{'ult_session'} = $this->get_format ($diff);
    }
    else{
      $dataUser{'ult_session'} = '-';
    }


    $rolUser  = RolUsers::where('id_user', auth()->user()->id)->where('id_tp_rol', '!=', 5)->with('getTpRol')->first();
    if($rolUser){
      $dataUser{'id_tp_rol'} = $rolUser->id_tp_rol;
      $dataUser{'tp_rol'}    = $rolUser->getTpRol->descripcion;
    }else {
      $dataUser{'id_tp_rol'} = null;
      $dataUser{'tp_rol'}    = $rolUser->getTpRol->descripcion;
    }


    $redUser         = UsersRed::where('id_users', $id)->with('getStatusRed', 'getUsersSponsor', 'getUsersSponsorCodigo')->first();
    $redUserMeActv   = UsersRed::where('id_users_sponsor',  $id)->where('id_status_red',1)->count();
    $redUserMeInactv = UsersRed::where('id_users_sponsor',  $id)->where('id_status_red',2)->count();
    $redUserTotal    = UsersRed::count();

    $dataRed = [
      "id"                 => $redUser->id,
      "id_users_sponsor"   => ($redUser->id_users_sponsor)?     $redUser->id_users_sponsor              : '-',
      "sponsor_nombres"    => ($redUser->id_users_sponsor)?     $redUser->getUsersSponsor->nombres      : '-',
      "sponsor_apellidos"  => ($redUser->id_users_sponsor)?     $redUser->getUsersSponsor->apellidos    : '-',
      "sponsor_email"      => ($redUser->id_users_sponsor)?     ($redUser->getUsersSponsor->email)? $redUser->getUsersSponsor->email : 'N/R'    : '-',
      "sponsor_usuario"   => ($redUser->id_users_sponsor)?     ($redUser->getUsersSponsorCodigo->username)? $redUser->getUsersSponsorCodigo->username : '-'    : '-',
      "redUserMe"          => ($redUserMeActv + $redUserMeInactv),
      "redUserMeActv"      => $redUserMeActv,
      "redUserMeInactv"    => $redUserMeInactv,
      "redUserTotal"       => $redUserTotal,


    ];

    $allData = [
      'dataUser' => (object) $dataUser,
      'dataRed'  => (object) $dataRed,

    ];
    return $allData;
  }

  //FORMATEAR FECHA
  public function get_format($df) {
     $str = '';
     $str .= ($df->invert == 1) ? ' - ' : '';
     if ($df->y > 0) {
         // years
         $str .= ($df->y > 1) ? $df->y . ' Años ' : $df->y . ' Año ';
     } if ($df->m > 0) {
         // month
         $str .= ($df->m > 1) ? $df->m . ' Meses ' : $df->m . ' Mes ';
     } if ($df->d > 0) {
         // days
         $str .= ($df->d > 1) ? $df->d . ' Días ' : $df->d . ' Dia ';
     } if ($df->h > 0) {
         // hours
         $str .= ($df->h > 1) ? $df->h . ' Horas ' : $df->h . ' Hora ';
     } if ($df->i > 0) {
         // minutes
         $str .= ($df->i > 1) ? $df->i . ' Minutos ' : $df->i . ' Minuto ';
     }

     return $str;
  }


}
