<?php

namespace App\Http\Controllers\App\Perfil;

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



class PerfilController extends AppBaseController
{

  public function validPermisoMenu($id_menu)
  {

    $roles = RolUsers::where('id_user', auth()->user()->id)->get();
    foreach ($roles as $key) {
      $menu = RolMenu::where('id_tp_rol', $key->id_tp_rol)->where('id_menu', $id_menu)->first();
      if ($menu) {
        return true;
      }
    }
    return false;
  }

  public function index()
  {

    ini_set('memory_limit', '-1');
    ini_set('max_execution_time', 999999);

    $main = new MenuClass();
    $main = $main->getMenu();

    $valor = $this->validPermisoMenu(26);
    if ($valor == false) {
      return view('errors.403', compact('main'));
    }


    $sexo        = TpSexo::WHERE('status', '=', 'TRUE')->orderBy('descripcion', 'ASC')->pluck('descripcion', 'id');
    $tp_document = TpDocumentIdenties::WHERE('status', '=', 'TRUE')->orderBy('description', 'ASC')->pluck('description', 'id');
    $id          = User::where('email', auth()->user()->email)->first()->id;
    $allData     = (object) $this->getData($id);

    if ($allData->dataUser->id_status_users_app == 1) {
      Flash::error('Debes completar tu registro.');
    }

    return view('app.perfil.index')
      ->with('usersApp',    $allData->dataUser)
      ->with('redUsersApp', $allData->dataRed)
      ->with('main',        $main);
  }

  public function getData($id)
  {
    $user = User::find($id);


    $dataUser = [
      "id"             => $user->id,
      "id_country"     => ($user->id_country) ?     $user->id_country              : null,

      "country"        => ($user->id_country) ?     $user->getCountry->country     : '-',
      "country_select" => Country::WHERE('status', '=', 'TRUE')->orderBy('country', 'ASC')->pluck('country', 'id'),

      "id_departament"     => ($user->id_departament) ? $user->id_departament                  : '-',
      "departament"        => ($user->id_departament) ? $user->getDepartament->departament     : '-',
      "departament_select" => ($user->id_country) ? Departament::WHERE('status', '=', 'TRUE')->where('id_country', $user->id_country)->orderBy('departament', 'ASC')->pluck('departament', 'id') : Departament::WHERE('status', '=', 'TRUE')->orderBy('departament', 'ASC')->pluck('departament', 'id'),

      "id_city"     => ($user->id_city) ? $user->id_city                  : '-',
      "city"        => ($user->id_city) ? $user->getCity->city     : '-',
      "city_select" => ($user->id_departament) ? City::WHERE('status', '=', 'TRUE')->where('id_departament', $user->id_departament)->orderBy('city', 'ASC')->pluck('city', 'id') : City::orderBy('city', 'ASC')->pluck('city', 'id'),

      "id_distrito"     => ($user->id_distrito) ? $user->id_distrito                  : '-',
      "distrito"        => ($user->id_distrito) ? $user->getDistritos->distrito       : '-',
      "distrito_select" => ($user->id_city) ? Distrito::WHERE('status', '=', 'TRUE')->where('id_city', $user->id_city)->orderBy('distrito', 'ASC')->pluck('distrito', 'id') : Distrito::orderBy('distrito', 'ASC')->pluck('distrito', 'id'),

      "id_tp_sexo"     => ($user->id_tp_sexo) ?     $user->id_tp_sexo      : '-',
      "sexo"           => ($user->id_tp_sexo) ?     $user->getSexo->descripcion     : '-',
      "sexo_select"    => TpSexo::WHERE('status', '=', 'TRUE')->orderBy('descripcion', 'ASC')->pluck('descripcion', 'id'),

      "first_name"     => ($user->first_name) ?     $user->first_name     : null,
      "middle_name"    => ($user->middle_name) ?    $user->middle_name    : null,
      "last_name"      => ($user->last_name) ?      $user->last_name   : null,
      "birth"          => ($user->birth) ?          $user->birth : '-',
      "phone"          => ($user->phone) ?          $user->phone    : null,
      "email"          => ($user->email) ?          $user->email    : '-',
      "address"        => ($user->address) ?        $user->address    : null,

      "created_at"     => ($user->created_at) ?     $user->created_at->format('d-m-Y') : '-',
      "updated_at"     => ($user->updated_at) ?     $user->updated_at->format('d-m-Y') : '-',
      "deleted_at"     => ($user->deleted_at) ?     $user->deleted_at->format('d-m-Y') : '-',

      "id_status_users_app" => ($user->id_status_users_app) ?  $user->id_status_users_app : '-',
      "status_users_app"    => ($user->id_status_users_app) ?  $user->getStatusUsersApp->status_users_app : '-',

      "id_tp_document_identies"    => ($user->id_tp_document_identies) ?     $user->id_tp_document_identies      : '-',
      "tp_document"                => ($user->id_tp_document_identies) ?     $user->getTpDocumentIdenties->description     : '-',
      "tp_document_ab"             => ($user->id_tp_document_identies) ?     $user->getTpDocumentIdenties->abbreviation     : '-',

      "n_document"                 => ($user->n_document) ?                  $user->n_document     : null,
      "tp_document_select"         => TpDocumentIdenties::WHERE('status', '=', 'TRUE')->where('id_country', $user->id_country)->orderBy('description', 'ASC')->pluck('description', 'id'),
    ];

    $datosSessionAnt = Session::where('token', auth()->user()->email)->where('id_status_session', 2)->orderby('updated_at', 'DESC')->first();

    if ($datosSessionAnt) {
      $date1 = new \DateTime($datosSessionAnt->updated_at);
      $date2 = new \DateTime("now");
      $diff = $date1->diff($date2);
      $dataUser{'ult_session'} = $this->get_format($diff);
    } else {
      $dataUser{'ult_session'} = '-';
    }


    $rolUser  = RolUsers::where('id_user', auth()->user()->id)->where('id_tp_rol', '!=', 5)->with('getTpRol')->first();
    if ($rolUser) {
      $dataUser{'id_tp_rol'} = $rolUser->id_tp_rol;
      $dataUser{'tp_rol'}    = $rolUser->getTpRol->descripcion;
    } else {
      $dataUser{'id_tp_rol'} = null;
      $dataUser{'tp_rol'}    = $rolUser->getTpRol->descripcion;
    }


    $redUser         = UsersRed::where('id_users_invitado', $id)->with('getStatusRed', 'getUsersSponsor')->first();
    $redUserMeActv   = UsersRed::where('id_users_sponsor',  $id)->where('id_status_red', 1)->count();
    $redUserMeInactv = UsersRed::where('id_users_sponsor',  $id)->where('id_status_red', 2)->count();
    $redUserTotal    = UsersRed::count();

    $dataRed = [
      "id"                 => $redUser->id,
      "id_users_sponsor"   => ($redUser->id_users_sponsor) ?     $redUser->id_users_sponsor              : '-',
      "sp_first_name"      => ($redUser->id_users_sponsor) ?     $redUser->getUsersSponsor->first_name      : '-',
      "sp_middle_name"     => ($redUser->id_users_sponsor) ?     $redUser->getUsersSponsor->middle_name      : '-',

      "sp_last_name"       => ($redUser->id_users_sponsor) ?     $redUser->getUsersSponsor->last_name    : '-',
      "sp_contacto"        => ($redUser->id_users_sponsor) ?     ($redUser->getUsersSponsor->phone) ? $redUser->getUsersSponsor->phone : 'N/R'    : '-',

      "id_users_invitado"  => ($redUser->id_users_invitado) ?    $redUser->id_users_invitado             : '-',
      "codigo_invitado"    => ($redUser->codigo_invitado) ?      $redUser->codigo_invitado               : '-',
      "usuario_invitado"   => ($redUser->usuario_invitado) ?     $redUser->usuario_invitado              : null,

      "created_at"         => ($redUser->created_at) ?           $redUser->created_at->format('d-m-Y')   : '-',
      "updated_at"         => ($redUser->updated_at) ?           $redUser->updated_at->format('d-m-Y')   : '-',
      "deleted_at"         => ($redUser->deleted_at) ?           $redUser->deleted_at->format('d-m-Y')   : '-',

      "id_status_red"      => ($redUser->id_status_red) ?        $redUser->id_status_red                 : '-',
      "status_red"         => ($redUser->id_status_red) ?        $redUser->getStatusRed->descripcion     : '-',

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

  public function store()
  {

    $input = request()->all();

    $input{'first_name'}  = mb_strtoupper($input{'first_name'});
    $input{'middle_name'} = mb_strtoupper($input{'middle_name'});
    $input{'last_name'}   = mb_strtoupper($input{'last_name'});

    $validator = Validator::make($input, [
      'first_name'     => 'required',
      'last_name'      => 'required',
      'birth'          => 'required',
      'id_tp_sexo'     => 'required',
      'phone'          => 'required',
      'id_country'     => 'required',
      'id_departament' => 'required',
      'id_city'        => 'required',
      'id_tp_document_identies' => 'required',
      'n_document'              => 'required'
    ]);

    if ($validator->fails()) {
      Flash::error('Hemos encontrado algunos errores.');
      return redirect(route('profile'))
        ->withErrors($validator)
        ->withInput();
    }


    try {
      DB::beginTransaction();

      $user = User::find(auth()->user()->id);
      $user->update($input);

      if ($user->id_status_users_app == 1) {
        $userSt = User::where('id', auth()->user()->id)
          ->where('first_name', '!=', null)
          ->where('last_name', '!=',null)
          ->where('birth', '!=',null)
          ->where('id_tp_sexo', '!=', null)
          ->where('phone', '!=',null)
          ->where('id_country', '!=',null)
          ->where('id_departament', '!=', null)
          ->where('id_city', '!=',null)
          ->where('id_tp_document_identies', '!=',null)
          ->where('n_document', '!=',null)
          ->first();
        if ($userSt) {

          $redUser  = UsersRed::where('id_users_invitado', auth()->user()->id)->with('getStatusRed', 'getUsersSponsor')->first();

          if($redUser->id_status_red == 2){
            $username = mb_strtolower(substr($input{'first_name'}, 0, 2).substr($input{'last_name'}, 0, 2)).rand(100000,999999);
            $redUser->usuario_invitado = $username;
            $redUser->id_status_red = 1;
            $redUser->update();
          }

          $userSt->id_status_users_app = 2;
          $userSt->update();
        }
      }

      DB::commit();
    } catch (\Exception $e) {
      // dd($e);
      DB::rollback();
      Flash::error('Hemos encontrado algunos errores.');
      return  redirect()->route('profile');
    }

    Flash::success('Actualizado de forma exitosa.');
    return  redirect()->route('profile');
  }

  public function edit()
  {
    $main = new MenuClass();
    $main = $main->getMenu();

    $valor = $this->validPermisoMenu(26);
    if ($valor == false) {
      return view('errors.403', compact('main'));
    }

    $id   = User::where('email', auth()->user()->email)->first()->id;
    $user = User::find($id);


    $pais     = Country::WHERE('status', '=', 'TRUE')->orderBy('country', 'ASC')->pluck('country', 'id');
    $sexo     = TpSexo::WHERE('status', '=', 'TRUE')->orderBy('descripcion', 'ASC')->pluck('descripcion', 'id');


    return view('app.perfil.index')
      ->with('usersApp', $user)
      ->with('pais',     $pais)
      ->with('sexo',     $sexo)
      ->with('main',     $main);
  }

  public function changePassword()
  {
    $main = new MenuClass();
    $main = $main->getMenu();

    $id       = User::where('email', auth()->user()->email)->first()->id;
    $user = User::find($id);

    return view('app.perfil.password')
      ->with('usersApp', $user)
      ->with('main',     $main);
  }

  public function savingPassword()
  {
    $user  = User::find(auth()->user()->id);
    $input = request()->all();

    $validator = Validator::make(
      $input,
      [
        'password'         => 'required|min:6',
        'password_confirm' => 'required|same:password|min:6'
      ],
      [
        'password_confirm.same' => 'Las contraseñas deben coincidir'
      ]
    );

    if ($validator->fails()) {
      Flash::error('No se logró realizar el cambio de contraseña, por favor abrir un ticket de atención.');
      return redirect(route('pass'))
        ->withErrors($validator)
        ->withInput();
    }

    try {
      DB::beginTransaction();

      $dataUser =  ['password'  => Hash::make($input{'password'}) ];


      $user = User::find(auth()->user()->id);
      if ($user) {

        $user->password = Hash::make($input{'password'});
        $user->update();

        $dataPasswordUserApp = [
          'id_users'         => auth()->user()->id,
          'password'         => Hash::make($input{'password'}),
          'password_repeat'  => Hash::make($input{'password'}),
          'status'           => true,
        ];

        $PasswordUsersAppUpd   = UsersPasswords::where('id_users', auth()->user()->id)->update(array('status' => 0));
        UsersPasswords::create($dataPasswordUserApp)->id;
      }

      DB::commit();
    } catch (\Exception $e) {
      DB::rollback();
      // dd($e);
      return  redirect()->route('pass');
    }

    Flash::success('La contraseña se ha guardado correctamente.');

    return  redirect()->route('pass');
  }

  public function get_format($df)
  {
    $str = '';
    $str .= ($df->invert == 1) ? ' - ' : '';
    if ($df->y > 0) {
      // years
      $str .= ($df->y > 1) ? $df->y . ' Años ' : $df->y . ' Año ';
    }
    if ($df->m > 0) {
      // month
      $str .= ($df->m > 1) ? $df->m . ' Meses ' : $df->m . ' Mes ';
    }
    if ($df->d > 0) {
      // days
      $str .= ($df->d > 1) ? $df->d . ' Días ' : $df->d . ' Dia ';
    }
    if ($df->h > 0) {
      // hours
      $str .= ($df->h > 1) ? $df->h . ' Horas ' : $df->h . ' Hora ';
    }
    if ($df->i > 0) {
      // minutes
      $str .= ($df->i > 1) ? $df->i . ' Minutos ' : $df->i . ' Minuto ';
    }

    return $str;
  }

  public function baseConocimiento()
  {
    $main = new MenuClass();
    $main = $main->getMenu();

    return view('app.ayuda.base_conocimiento', compact('main'));
  }
  public function tutoriales()
  {
    $main = new MenuClass();
    $main = $main->getMenu();

    return view('app.ayuda.tutoriales', compact('main'));
  }
  public function redesSociales()
  {
    $main = new MenuClass();
    $main = $main->getMenu();

    return view('app.ayuda.redes_sociales', compact('main'));
  }
  public function mapRedesSociales()
  {
    $main = new MenuClass();
    $main = $main->getMenu();

    $valor = $this->validPermisoMenu(26);
    if ($valor == false) {
      return view('errors.403', compact('main'));
    }

    return view('app.ayuda.map_redes_sociales', compact('main'));
  }
  public function comunidadWin()
  {
    $main = new MenuClass();
    $main = $main->getMenu();

    return view('app.ayuda.comunidad_win', compact('main'));
  }
  public function crearTicket()
  {
    $main = new MenuClass();
    $main = $main->getMenu();

    $valor = $this->validPermisoMenu(26);
    if ($valor == false) {
      return view('errors.403', compact('main'));
    }

    return view('app.soporte.crear_ticket', compact('main'));
  }
  public function verTicket()
  {
    $main = new MenuClass();
    $main = $main->getMenu();

    $valor = $this->validPermisoMenu(26);
    if ($valor == false) {
      return view('errors.403', compact('main'));
    }

    return view('app.soporte.ver_ticket', compact('main'));
  }
  public function winbotOnline()
  {
    $main = new MenuClass();
    $main = $main->getMenu();

    $valor = $this->validPermisoMenu(26);
    if ($valor == false) {
      return view('errors.403', compact('main'));
    }

    return view('app.soporte.winbot_online', compact('main'));
  }
}
