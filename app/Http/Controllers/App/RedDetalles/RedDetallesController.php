<?php

namespace App\Http\Controllers\App\RedDetalles;

use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Models\UsersRed;
use App\Models\RolUsers;
use App\Models\RolMenu;
use App\Models\Country;
use App\Models\Session;
use App\User;
use Auth;
use Flash;
use Response;

use App\Classes\MenuClass;
use App\Models\Menu;



class RedDetallesController extends AppBaseController
{

    //VALIDACION DE ACCESO
    public function validPermisoMenu($id_menu) {

      $roles = RolUsers::where('id_user', auth()->user()->id)->get();
      foreach ($roles as $key) {
          $menu = RolMenu::where('id_tp_rol', $key->id_tp_rol)->where('id_menu', $id_menu)->first();

          if($menu){
            return true;
          }

        }

      return false;

    }
    //GETSION DE ACCESOA VISTA

    public function redDetalles() {

      $acceso  = url()->current();
      $dns     = \URL::to('/');
      $cant    = strlen($dns);
      $final   = strlen($acceso);

      $acceso  = substr ($acceso, $cant, $final);

      $main         = new MenuClass();
      $main         = $main->getMenu();

      $id_sponsor   = User::where('email',   auth()->user()->email)->first()->id;
      $dataUser     = User::find($id_sponsor);
      $rolUser      = RolUsers::where('id_user', auth()->user()->id)->where('id_tp_rol', '!=', 5)->with('getTpRol')->first();

      if($rolUser){
        $dataUser{'id_tp_rol'} = $rolUser->id_tp_rol;
        $dataUser{'tp_rol'}    = $rolUser->getTpRol->descripcion;

      }
      else {
        $dataUser{'id_tp_rol'} = null;
        $dataUser{'tp_rol'}    = $rolUser->getTpRol->descripcion;
      }

      if($rolUser->id_tp_rol     == 2 && $acceso == '/redDetalles'){
        $menu = 29;
      }
      elseif($rolUser->id_tp_rol == 3 && $acceso == '/redConductor'){
        $menu = 32;
      }
      elseif($rolUser->id_tp_rol == 4 && $acceso == '/redPasajero'){
        $menu = 33;
      }
      else{
        return view('errors.403', compact('main'));
      }

      $valor = $this->validPermisoMenu($menu);
      if ($valor == false){
        return view('errors.403', compact('main'));
      }
      $filtros= [
        'codigo_invitado'   => 'Código',
        'usuario_invitado'  => 'Usuario',
      ];

      return view('App.red_detalles.show')
        ->with('main',      $main)
        ->with('rol',       $rolUser)
        ->with('filtros',   $filtros)
        ->with('dataUser',  $dataUser)
        ->with('sponsor',   $id_sponsor);


    }

    //RED INDIRECTA
    public function redDirecta()
    {
      $sponsor = request()->sponsor;
      $query = UsersRed::where('id_users_sponsor', $sponsor)->with('getStatusRed', 'getUsersInvitado', 'getUsersSponsorCodigo')->get();
       return response()->json([
         'data'  => $query,
         'nivel' => '1',
         'cant'  => count($query),
       ]);
    }

    //RED INDIRECTA
    public function redInDirecta()
    {

      $sponsorPadre = request()->sponsor;
      $queryPadre   = UsersRed::where('id_users_sponsor', $sponsorPadre)
                      ->select('id_users_invitado')
                      ->get();

      $query = UsersRed::with('getStatusRed', 'getUsersInvitado')
              ->whereIn('id_users_sponsor',$queryPadre)
              ->get();

       return response()->json([
         'data'  => $query,
         'nivel' => '2',
         'cant'  => count($query),
       ]);
    }

    //BUSCAMOS LA LISTA DE USUARIOS POR NIVEL PARA TODA LA RED
    public function redBusquedaNivel()
    {
      $sponsorPadre  = request()->sponsor;
      $nivelBusqueda = request()->nivelBusqueda;
      $nivelBusqueda = (int)$nivelBusqueda;

      $redRecorrido  = true;
      $flag          = false;

      $dato          = [];
      $nivel         = 1;
      $cant          = 0;

      do{

        if ($nivel == 1){
          $data      = UsersRed::where('id_users_sponsor', $sponsorPadre)
          ->with('getStatusRed', 'getUsersInvitado', 'getUsersSponsorCodigo')->get();
          $cant  = count($data);
          if ($cant == 0){
            $redRecorrido = false;
            //IMPRIMO NO HAY NADA
          }else{
            //SI NO ES EL UNO QUIERO LOS DEMAS CODIGOS PARA CONTINUAR
            if($nivelBusqueda != $nivel){
              $codigos = UsersRed::where('id_users_sponsor', $sponsorPadre)->select('id_users_invitado')->get();
              $cant    = count($data);
              if($cant == 0){
                $redRecorrido = false;
              }
            }else {
              //termino mi busqueda
              $redRecorrido = false;
            }
          }
        }

        else{
          $data = UsersRed::with('getStatusRed', 'getUsersInvitado','getUsersSponsorCodigo')->whereIn('id_users_sponsor',$codigos)->get();
          $cant = count($data);
          if($cant == 0){
            $redRecorrido = false;
          }

          else{

            //SI NO ES EL UNO QUIERO LOS DEMAS CODIGOS PARA CONTINUAR
            if($nivelBusqueda == $nivel){
              $redRecorrido = false;
            }else {
              $codigos   = UsersRed::whereIn('id_users_sponsor',$codigos)->select('id_users_invitado')->get();
              if(count($codigos) == 0){
                $redRecorrido = false;
              //termino mi busqueda
            }
          }


        }
      }
        if ($cant > 0 && $nivel == $nivelBusqueda){
          $dato = [
            'nivel'   => $nivelBusqueda,
            'data'    => $data,
            'cant'    => $cant,
          ];
        }
        $nivel++;

      }while($redRecorrido == true);


      if ($dato){
        return response()->json([
          'data'  => $dato{'data'},
          'nivel' => $dato{'nivel'},
          'cant'  => $dato{'cant'},
        ]);
      }
      else{
        return response()->json([
          'data'  => false,
        ]);


      }

    }

    //CANTIDAD DE USUARIOS EN MI RED TOTAL
    public function totalRedCompleta()
    {
      $sponsorPadre  = request()->sponsor;
      $redRecorrido  = true;
      $data          = null;
      $nivel         = 1;
      $redDirecta    = 0;
      $redInDirecta  = 0;
      $cant          = 0;
      $cantTotal     = 0;
      $datos         = [];


      do{
        if ($nivel == 1){
          $data      = UsersRed::where('id_users_sponsor', $sponsorPadre)->with('getStatusRed', 'getUsersInvitado', 'getUsersSponsorCodigo')->get();
          $redDirecta = count($data);
          if (count($data) == 0){
            $redRecorrido = false;
          }else{
            $codigos = UsersRed::where('id_users_sponsor', $sponsorPadre)->select('id_users_invitado')->get();
            $cant    = count($data);
            if($cant == 0){
              $redRecorrido = false;
            }
          }
        }

        else{
          $data = UsersRed::with('getStatusRed', 'getUsersInvitado','getUsersSponsorCodigo')->whereIn('id_users_sponsor',$codigos)->get();
          if($nivel == 2){
            $redInDirecta = count($data);
          }
          if (count($data) == 0){
            $redRecorrido = false;
          }
          else{
            $codigos   = UsersRed::whereIn('id_users_sponsor',$codigos)->select('id_users_invitado')->get();
            $cant = count($data);
            if($cant == 0){
              $redRecorrido = false;
            }
          }
        }

        if ($cant > 0){
          $dato = [
            'nivel'     => $nivel,
            'cant'      => $cant,
          ];
          $dato  = (object)  $dato;
          array_push($datos, $dato);
          $cantTotal = $cant + $cantTotal;
          $nivel++;
          $cant = 0;
        }

      }while($redRecorrido == true);

      // dd($datos);
      return response()->json([
        'total_red'     => $cantTotal,
        'red_directa'   => $redDirecta,
        'red_indirecta' => $redInDirecta,
        'flag'          => true,
        'data'          => $datos,
      ]);
    }

    //CANTIDAD DE USUARIOS EN MI RED ENTRE LOS DIRECTOS E INDIRECTOS
    public function totalRedSimple()
    {
      $sponsorPadre  = request()->sponsor;
      $redRecorrido  = true;
      $data          = null;
      $cantTotal     = 0;
      $datos         = [];

      $data1   = UsersRed::where('id_users_sponsor', $sponsorPadre)->with('getStatusRed', 'getUsersInvitado', 'getUsersSponsorCodigo')->get();
      $codigos = UsersRed::where('id_users_sponsor', $sponsorPadre)->select('id_users_invitado')->get();
      $cant1   = count($data1);
      $dato    = [ 'nivel' => 1, 'cant' => $cant1];
      array_push($datos, $dato);

      $data2 = UsersRed::with('getStatusRed', 'getUsersInvitado','getUsersSponsorCodigo')->whereIn('id_users_sponsor',$codigos)->get();
      $cant2 = count($data2);
      $dato = [ 'nivel' => 2, 'cant' => $cant2];
      array_push($datos, $dato);



      return response()->json([
      'total_red'     => $cant1 + $cant2,
      'flag'          => true,
      'data'          => $datos,
      ]);
    }

    //ESTO ES PARA SOLO BUSCAR ENTRE TODOS LOS USUARIOS DEPENDIENTES DE MI RED
    public function busquedaUsuarioCompleta()
    {
      $mensaje = 'No hemos encontrado su búsqueda';
      $flag    = false;

      $sponsorPadre    = request()->sponsor;
      $campodeBusqueda = request()->campodeBusqueda;
      $campo           = request()->campo;


      $existe = UsersRed::where($campodeBusqueda, $campo)->first();
      if(!$existe){
        return response()->json([
          'data'     => null,
          'flag'     => $flag,
          'mensaje'  => $mensaje,
        ]);
      }

      $redRecorrido  = true;
      $nivel         = 1;
      $n             = 0;
      $data          = null;
      $busquedaFinal = null;
      $codiugos      = null;
      $datos         = [];
      $cant          = 0;


      do{
        if ($nivel == 1){
          $data      = UsersRed::where('id_users_sponsor', $sponsorPadre)->where($campodeBusqueda, $campo)
                      ->with('getStatusRed', 'getUsersInvitado', 'getUsersSponsorCodigo')->first();

          if($data != null){
            $redRecorrido = false;
            $mensaje = 'Hemos encontrado su búsqueda';
            $flag    = true;
          }
          else{
            $codigos   = UsersRed::where('id_users_sponsor',$sponsorPadre)->select('id_users_invitado')->get();
            if(count($codigos)  == 0 ){
              $redRecorrido = false;
            }
          }
        }

        else{
          $data = UsersRed::with('getStatusRed', 'getUsersInvitado', 'getUsersSponsorCodigo')
                  ->where($campodeBusqueda, $campo)->whereIn('id_users_sponsor',$codigos)->first();

          if($data != null){
            $redRecorrido = false;
            $mensaje = 'Hemos encontrado su búsqueda';
            $flag    = true;
          }else{
            $codigos   = UsersRed::whereIn('id_users_sponsor',$codigos)->select('id_users_invitado')->get();
            if(count($codigos) == 0)
            {
              $redRecorrido = false;
            }
          }
        }

        if ($redRecorrido == false && $flag == true){
          $busquedaFinal = [
            'nivel'   => $nivel,
            'usuario' => $data,
          ];
        }else {
          $nivel++;
        }

      }while($redRecorrido == true);
      if ($busquedaFinal){
        $busquedaFinal = $this->getDataPerfil($busquedaFinal{'usuario'}->id_users_invitado);
        $busquedaFinal{'nivel'} = $nivel;
      }
      return response()->json([
        'data'     => $busquedaFinal,
        'flag'     => $flag,
        'mensaje'  => $mensaje,
      ]);


    }

    //ESTO ES PARA SOLO BUSCAR ENTRE LOS DIRECTOS E INDIRECTOS
    public function busquedaUsuarioSimple()
    {
      $mensaje = 'No hemos encontrado su búsqueda';
      $flag    = false;

      $sponsorPadre    = request()->sponsor;
      $campodeBusqueda = request()->campodeBusqueda;
      $campo           = request()->campo;


      $existe = UsersRed::where($campodeBusqueda, $campo)->first();
      if(!$existe){
        return response()->json([
          'data'     => null,
          'flag'     => $flag,
          'mensaje'  => $mensaje,
        ]);
      }

      $redRecorrido  = true;
      $nivel         = 1;
      $n             = 0;
      $data          = null;
      $busquedaFinal = null;
      $codiugos      = null;
      $datos         = [];
      $cant          = 0;


      do{
        if ($nivel == 1){
          $data      = UsersRed::where('id_users_sponsor', $sponsorPadre)->where($campodeBusqueda, $campo)
                      ->with('getStatusRed', 'getUsersInvitado','getUsersSponsorCodigo')->first();

          if($data != null){
            $redRecorrido = false;
            $mensaje = 'Hemos encontrado su búsqueda';
            $flag    = true;
          }
          else{
            $codigos   = UsersRed::where('id_users_sponsor',$sponsorPadre)->select('id_users_invitado')->get();
            if(count($codigos)  == 0 ){
              $redRecorrido = false;
            }
          }
        }

        else{
          $data = UsersRed::with('getStatusRed', 'getUsersInvitado','getUsersSponsorCodigo')
                  ->where($campodeBusqueda, $campo)->whereIn('id_users_sponsor',$codigos)->first();

          if($data != null){
            $redRecorrido = false;
            $mensaje = 'Hemos encontrado su búsqueda';
            $flag    = true;
          }else{
            $codigos   = UsersRed::whereIn('id_users_sponsor',$codigos)->select('id_users_invitado')->get();
            if(count($codigos) == 0)
            {
              $redRecorrido = false;
            }
          }
        }

        if ($redRecorrido == false && $flag == true){
          $busquedaFinal = [
            'nivel'   => $nivel,
            'usuario' => $data,
          ];
        }else {
          $nivel++;
        }

      }while($redRecorrido == true  && $nivel < 3);
      if ($busquedaFinal){
        $busquedaFinal = $this->getDataPerfil($busquedaFinal{'usuario'}->id_users_invitado);
        $busquedaFinal{'nivel'} = $nivel;
      }
      return response()->json([
        'data'     => $busquedaFinal,
        'flag'     => $flag,
        'mensaje'  => $mensaje,
      ]);


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

        "first_name"     => ($usersApp->first_name)?     $usersApp->first_name     : null,
        "middle_name"    => ($usersApp->middle_name)?    $usersApp->middle_name    : '',

        "last_name"      => ($usersApp->last_name)?      $usersApp->last_name   : null,
        "f_nacimiento"   => ($usersApp->birth)?          $usersApp->birth    : '-',
        "phone"          => ($usersApp->phone)?          $usersApp->phone    : null,
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


      $redUser         = UsersRed::where('id_users_invitado', $id)->with('getStatusRed', 'getUsersSponsor', 'getUsersSponsorCodigo')->first();
      $redUserMeActv   = UsersRed::where('id_users_sponsor',  $id)->where('id_status_red',1)->count();
      $redUserMeInactv = UsersRed::where('id_users_sponsor',  $id)->where('id_status_red',2)->count();
      $redUserTotal    = UsersRed::count();

      $dataRed = [
        "id"                 => $redUser->id,
        "id_users_sponsor"   => ($redUser->id_users_sponsor )? $redUser->id_users_sponsor              : '-',
        "sponsor_nombres"    => ($redUser->id_users_sponsor )? $redUser->getUsersSponsor->first_name      : '-',
        "sponsor_apellidos"  => ($redUser->id_users_sponsor )? $redUser->getUsersSponsor->last_name    : '-',
        "sponsor_email"      => ($redUser->id_users_sponsor )? ($redUser->getUsersSponsor->email)? $redUser->getUsersSponsor->email : 'N/R'    : '-',
        "sponsor_usuario"    => ($redUser->id_users_sponsor )? ($redUser->getUsersSponsorCodigo->usuario_invitado)? $redUser->getUsersSponsorCodigo->usuario_invitado : '-'    : '-',
        "sponsor_codigo"     => ($redUser->id_users_sponsor )? ($redUser->getUsersSponsorCodigo->codigo_invitado )? $redUser->getUsersSponsorCodigo->codigo_invitado : '-'    : '-',
        "usuario_invitado"   => ($redUser->id_users_invitado)? ($redUser->usuario_invitado)? $redUser->usuario_invitado : '-'    : '-',
        "codigo_invitado"    => ($redUser->id_users_invitado)? ($redUser->codigo_invitado)?  $redUser->codigo_invitado  : '-'    : '-',
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
