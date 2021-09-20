<?php

namespace App\Http\Controllers\Widgest;

use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\RolMenu;
use App\Models\Departament;
use App\Models\Country;
use App\Models\City;
use App\Models\Distrito;
use App\Models\TpSexo;
use App\Models\TpDocumentIdenties;
use App\Models\Session;
use App\Models\User;
use App\Models\RolUsers;
use App\Models\UsersRed;
use App\Models\UsersPasswords;
use App\Models\StatusUsersApp;
use App\User;
use Auth;
use Flash;
use Response;

use App\Classes\MenuClass;
use App\Models\Menu;

class WidgetController extends AppBaseController
{
  public function perfil()
  {
    $sexo     = TpSexo::WHERE('status', '=', true)->orderBy('descripcion', 'ASC')->pluck('descripcion', 'id');
    $tp_document = TpDocumentIdenties::WHERE('status', '=', true)->orderBy('description', 'ASC')->pluck('description', 'id');
    $id       = User::where('email', auth()->user()->email)->first()->id;
    $allData  = (object) $this->getDataPerfil($id);

    return view('widgets.perfil')
    ->with('usersApp',    $allData->dataUser)
    ->with('redUsersApp', $allData->dataRed);

  }

  public function getDataPerfil($id)
  {
    $usersApp = User::find($id);
    $dataUser = [
      "id"             => $usersApp->id,

      "id_country"     => ($usersApp->id_country)?     $usersApp->id_country              : null,
      "country"        => ($usersApp->id_country)?     $usersApp->getCountry->country     : '-',
      "country_select" => Country::WHERE('status', '=', true)->orderBy('country', 'ASC')->pluck('country', 'id'),

      "id_departament"     => ($usersApp->id_departament)? $usersApp->id_departament                  : '-',
      "departament"        => ($usersApp->id_departament)? $usersApp->getDepartament->departament     : '-',
      "departament_select" => ($usersApp->id_country)? Departament::WHERE('status', '=', true)->where('id_country',$usersApp->id_country)->orderBy('departament', 'ASC')->pluck('departament', 'id') : Departament::WHERE('status', '=', true)->orderBy('departament', 'ASC')->pluck('departament', 'id') ,

      "id_city"     => ($usersApp->id_city)? $usersApp->id_city                  : '-',
      "city"        => ($usersApp->id_city)? $usersApp->getCity->city     : '-',
      "city_select" => ($usersApp->id_departament)? City::WHERE('status', '=', true)->where('id_departament',$usersApp->id_departament)->orderBy('city', 'ASC')->pluck('city', 'id') : City::orderBy('city', 'ASC')->pluck('city', 'id'),

      "id_distrito"     => ($usersApp->id_distrito)? $usersApp->id_distrito                  : '-',
      "distrito"        => ($usersApp->id_distrito)? $usersApp->getDistritos->distrito       : '-',
      "distrito_select" => ($usersApp->id_city)? Distrito::WHERE('status', '=', true)->where('id_city',$usersApp->id_city)->orderBy('distrito', 'ASC')->pluck('distrito', 'id') : Distrito::orderBy('distrito', 'ASC')->pluck('distrito', 'id'),

      "id_tp_sexo"     => ($usersApp->id_tp_sexo)?     $usersApp->id_tp_sexo      : '-',
      "sexo"           => ($usersApp->id_tp_sexo)?     $usersApp->getSexo->descripcion     : '-',
      "sexo_select"    => TpSexo::WHERE('status', '=', true)->orderBy('descripcion', 'ASC')->pluck('descripcion', 'id'),

      "nombres"        => ($usersApp->nombres)?        $usersApp->nombres     : null,
      "apellidos"      => ($usersApp->apellidos)?      $usersApp->apellidos   : null,
      "f_nacimiento"   => ($usersApp->f_nacimiento)?   $usersApp->f_nacimiento->format('Y-m-d') : '-',
      "telefono"       => ($usersApp->telefono)?       $usersApp->telefono    : null,
      "email"          => ($usersApp->email)?          $usersApp->email    : '-',
      "created_at"     => ($usersApp->created_at)?     $usersApp->created_at->format('d-m-Y') : '-',
      "updated_at"     => ($usersApp->updated_at)?     $usersApp->updated_at->format('d-m-Y') : '-',
      "deleted_at"     => ($usersApp->deleted_at)?     $usersApp->deleted_at->format('d-m-Y') : '-',

      "id_status_users_app" => ($usersApp->id_status_users_app)?  $usersApp->id_status_users_app : '-',
      "status_users_app"    => ($usersApp->id_status_users_app)?  $usersApp->getStatusUsersApp->status_users_app : '-',

      "id_tp_document"      => ($usersApp->id_tp_document)?     $usersApp->id_tp_document      : '-',
      "tp_document"         => ($usersApp->id_tp_document)?     $usersApp->getTypeDocumentIdenties->description     : '-',
      "nro_document"        => ($usersApp->nro_document)?     $usersApp->nro_document     : '-',
      "tp_document_select"  => TpDocumentIdenties::WHERE('status', '=', true)->orderBy('description', 'ASC')->pluck('description', 'id'),

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


    $redUser         = UsersRed::where('id_users_invitado', $id)->with('getStatusRed', 'getUsersSponsor')->first();
    $redUserMeActv   = UsersRed::where('id_users_sponsor',  $id)->where('id_status_red',1)->count();
    $redUserMeInactv = UsersRed::where('id_users_sponsor',  $id)->where('id_status_red',2)->count();
    $redUserTotal    = UsersRed::count();

    $dataRed = [
      "id"                 => $redUser->id,
      "id_users_sponsor"   => ($redUser->id_users_sponsor)?     $redUser->id_users_sponsor              : '-',
      "sponsor_nombres"    => ($redUser->id_users_sponsor)?     $redUser->getUsersSponsor->nombres      : '-',
      "sponsor_apellidos"  => ($redUser->id_users_sponsor)?     $redUser->getUsersSponsor->apellidos    : '-',
      "sponsor_contacto"   => ($redUser->id_users_sponsor)?     ($redUser->getUsersSponsor->telefono)? $redUser->getUsersSponsor->telefono : 'N/R'    : '-',

      "id_users_invitado"  => ($redUser->id_users_invitado)?    $redUser->id_users_invitado             : '-',
      "codigo_invitado"    => ($redUser->codigo_invitado)?      $redUser->codigo_invitado               : '-',
      "usuario_invitado"   => ($redUser->usuario_invitado)?     $redUser->usuario_invitado              : null,

      "created_at"         => ($redUser->created_at)?           $redUser->created_at->format('d-m-Y')   : '-',
      "updated_at"         => ($redUser->updated_at)?           $redUser->updated_at->format('d-m-Y')   : '-',
      "deleted_at"         => ($redUser->deleted_at)?           $redUser->deleted_at->format('d-m-Y')   : '-',

      "id_status_red"      => ($redUser->id_status_red)?        $redUser->id_status_red                 : '-',
      "status_red"         => ($redUser->id_status_red)?        $redUser->getStatusRed->descripcion     : '-',

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
