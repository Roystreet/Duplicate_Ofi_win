<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateAgentsRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UsersAppRepository;
use Illuminate\Support\Facades\Validator;
use App\Classes\MenuClass;
use App\Models\RolUsers;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Models\StatusUsersApp;
use App\Models\Country;
use App\Models\Departament;
use App\Models\City;
use App\Models\Distrito;
use App\Models\TpSexo;
use App\Models\RolMenu;
use Flash;
use App\Models\UsersPasswords;
use Illuminate\Support\Facades\Hash;
use App\Models\UsersRed;
use App\Models\Session;

class AgentsController extends Controller
{
  /** @var  UsersAppRepository */
  private $usersAppRepository;

  public function __construct(UsersAppRepository $usersAppRepo)
  {
      $this->usersAppRepository = $usersAppRepo->with('getSexo', 'getCountry', 'getDepartament', 'getStatusUsersApp', 'getDistritos', 'getTpDocumentIdenties');
  }

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

  public function index(Request $request)
  {
    $main = new MenuClass();
    $main = $main->getMenu();

    $valor = $this->validPermisoMenu(15);
    if ($valor == false){
      return view('errors.403', compact('main'));
    }

    $pais          = Country       ::WHERE('status', '=', 'TRUE')->orderBy('country',          'ASC')->pluck('country',          'id');


    return view('admin.agents.index')
      ->with('pais',          $pais)
      ->with('main',          $main);

  }

  public function getAgents(Request $request)
  {
     ini_set('memory_limit','-1');

     $formulario    = request()->formulario;

     $data = (new User)->newQuery()->with(
                         'getSexo',
                         'getCountry',
                         'getDepartament',
                         'getStatusUsersApp'
                                    );

      if($formulario{'name'               }) {
        $data = $data->orWhere('first_name', 'like', '%' .mb_strtoupper($formulario{'name'}) . '%');
        $data = $data->orWhere('last_name', 'like', '%' .mb_strtoupper($formulario{'name'} ). '%');
        $data = $data->orWhere('middle_name', 'like', '%' .mb_strtoupper($formulario{'name'}) . '%');

      }
     if($formulario{'email'              }) { $data = $data->where('email', mb_strtolower($formulario{'email'              }));}
     if($formulario{'phone'              }) { $data = $data->where('phone',               $formulario{'phone'           });}
     if($formulario{'id_country'         }) { $data = $data->where('id_country',          $formulario{'id_country'         });}

     $data = $data->where('isexterno',  false);

     $data = $data->get();

     return response()->json([
       'data' => $data,
     ]);
  }

  public function create()
  {
      $main = new MenuClass();
      $main = $main->getMenu();
      $usersApp = null;

      $valor = $this->validPermisoMenu(15);
      if ($valor == false){
        return view('errors.403', compact('main'));
      }

      $pais           = Country       ::WHERE('status', '=', 'TRUE')->orderBy('country',          'ASC')->pluck('country',          'id');
      $departamentos  = Departament   ::WHERE('status', '=', 'TRUE')->orderBy('departament',      'ASC')->pluck('departament',      'id');
      $ciudad         = City          ::WHERE('status', '=', 'TRUE')->orderBy('city',             'ASC')->pluck('city',             'id');
      $distrito       = Distrito      ::WHERE('status', '=', 'TRUE')->orderBy('distrito',         'ASC')->pluck('distrito',         'id');
      $sexo           = TpSexo        ::WHERE('status', '=', 'TRUE')->orderBy('descripcion',      'ASC')->pluck('descripcion',      'id');
      $username = '';


      return view('admin.agents.create', compact('pais', 'departamentos', 'ciudad', 'distrito', 'sexo','username'))
      ->with('main',     $main)
      ->with('usersApp', $usersApp);
  }

  public function store(Request $request)
  {
      $input = $request->all();
      $input{'first_name'} = mb_strtoupper($input{'first_name'  });
      $input{'last_name'} = mb_strtoupper($input{'last_name'});
      $input{'email'    } = mb_strtolower($input{'email'    });

      $validator = Validator::make($input, [
        'email'     => 'required|unique:users',
        'phone'     => 'required|unique:users',
        'username'     => 'required|unique:users_red',
        'password'         => 'required|min:6',
        'password_confirm' => 'required|same:password|min:6'
      ]);

      if ($validator->fails()) {
          return redirect(route('agentes.create'))
                      ->withErrors($validator)
                      ->withInput();
      }

      $dataUser = [
          'id_tp_sexo' =>  $input{'id_tp_sexo'},
          'id_country' =>  $input{'id_country'},
          'id_departament' =>  $input{'id_departament'},
          'id_city' =>  $input{'id_city'},
          'id_distrito' =>  $input{'id_distrito'},
          'first_name' => $input{'first_name'},
          'last_name' => $input{'last_name'},
          'birth' => $input{'birth'},
          'phone' => $input{'phone'},
          'isexterno'            => false,
          'id_status_users_app'  => 2,
          'email'                => mb_strtolower($input{'email'}),
          'password'             => Hash::make($input{'password'}),
        ];
        $id_user = User::create($dataUser)->id;

        $dataPasswordUserApp = [
          'id_users'         => $id_user,
          'password'         => Hash::make($input{'password'}),
          'password_repeat'  => Hash::make($input{'password'}),
          'status'           => true,
        ];
        UsersPasswords::create($dataPasswordUserApp)->id;

        $dataUsersRed = [
          'id_users'         => $id_user,
          'id_users_sponsor' => 1,
          'username'         => $input{'username'},
          'id_status_red'    => 1,
          'status'           => true,
        ];
        UsersRed::create($dataUsersRed)->id;

      Flash::success('Agente guardado con éxito');

      return redirect(route('agentes.index'));
  }

  public function show($id)
  {
      $main = new MenuClass();
      $main = $main->getMenu();

      $valor = $this->validPermisoMenu(15);
      if ($valor == false){
        return view('errors.403', compact('main'));
      }

      $usersApp = $this->usersAppRepository->find($id);

      if (empty($usersApp)) {
          // Flash::error('Usuario no encontrado');
          return redirect(route('agentes.index'));
      }

      $datosSessionAnt = Session::where('token', auth()->user()->email)
      ->where('id_status_session', 2)->orderby('updated_at','DESC')->first();

      if($datosSessionAnt){
        $date1 = new \DateTime($datosSessionAnt->updated_at);
        $date2 = new \DateTime("now");
        $diff = $date1->diff($date2);
        $usersApp{'ult_session'} = $this->get_format ($diff);
      }
      else{
        $usersApp{'ult_session'} = '-';
      }

      return view('admin.agents.show')
      ->with('usersApp', $usersApp)
      ->with('main',     $main);
  }

  public function edit($id)
  {
    $main = new MenuClass();
    $main = $main->getMenu();

    $valor = $this->validPermisoMenu(15);
    if ($valor == false){
      return view('errors.403', compact('main'));
    }

    $pais           = Country       ::WHERE('status', '=', true)->orderBy('country',          'ASC')->pluck('country',          'id');
    $departamentos  = Departament   ::WHERE('status', '=', true)->orderBy('departament',      'ASC')->pluck('departament',      'id');
    $ciudad         = City          ::WHERE('status', '=', true)->orderBy('city',             'ASC')->pluck('city',             'id');
    $distrito       = Distrito      ::WHERE('status', '=', true)->orderBy('distrito',         'ASC')->pluck('distrito',         'id');
    $sexo           = TpSexo        ::WHERE('status', '=', true)->orderBy('descripcion',      'ASC')->pluck('descripcion',      'id');
    $estatus_users  = StatusUsersApp::WHERE('status', '=', true)->orderBy('status_users_app', 'ASC')->pluck('status_users_app', 'id');
    $username       = UsersRed::WHERE('id_users', '=', $id)->first();
    $usersApp = $this->usersAppRepository->find($id);

      if (empty($usersApp)) {
          Flash::error('Usuario no encontrado');
          return redirect(route('agentes.index'));
      }

      return view('admin.agents.edit')
      ->with ('usersApp',      $usersApp)
      ->with ('username',      ($username) ? $username->username : '')
      ->with ('pais',          $pais)
      ->with ('departamentos', $departamentos)
      ->with ('ciudad',        $ciudad)
      ->with ('distrito',      $distrito)
      ->with ('sexo',          $sexo)
      ->with ('estatus_users', $estatus_users)
      ->with ('main',          $main);

  }

  public function update($id, Request $request)
  {
      $usersApp = $this->usersAppRepository->find($id);

      if (empty($usersApp)) {
          // Flash::error('Usuario no encontrado');

          return redirect(route('agents.index'));
      }
              $input = $request->all();
              $input{'first_name'} = mb_strtoupper($input{'first_name'  });
              $input{'last_name'}    = mb_strtoupper($input{'last_name'});
              $input{'email'    }    = mb_strtolower($input{'email'    });

              $validator = Validator::make($input, [

                  'email'    => 'required|unique:users,email,'.$id,
                  'phone'    => 'required|unique:users,phone,'.$id
              ]);

              if ($validator->fails()) {
                  return redirect(route('agentes.create'))
                              ->withErrors($validator)
                              ->withInput();
              }

              $dataUser = [
                  'id_tp_sexo' =>  $input{'id_tp_sexo'},
                  'id_country' =>  $input{'id_country'},
                  'id_departament' =>  $input{'id_departament'},
                  'id_city' =>  $input{'id_city'},
                  'id_distrito' =>  $input{'id_distrito'},
                  'first_name' => $input{'first_name'},
                  'last_name' => $input{'last_name'},
                  'birth' => $input{'birth'},
                  'phone' => $input{'phone'},
                  'isexterno'            => false,
                  'id_status_users_app'  => 2,
                  'email'                => mb_strtolower($input{'email'}),
                  'password'             => Hash::make($input{'password'}),
                ];
                User::where('id', $id)->update($dataUser);

                $dataPasswordUserApp = [
                  'password'         => Hash::make($input{'password'}),
                  'password_repeat'  => Hash::make($input{'password'}),
                  'status'           => true,
                ];
                UsersPasswords::where('id_users', $id)->update($dataPasswordUserApp);

                $dataUsersRed = [
                  'id_users_sponsor' => 1,
                  'username'         => $input{'username'},
                  'id_status_red'    => 1,
                  'status'           => true,
                ];
                UsersRed::where('id_users', $id)->update($dataUsersRed);

                Flash::success('Usuario actualizado correctamente.');

                return redirect(route('agentes.index'));
  }

}
