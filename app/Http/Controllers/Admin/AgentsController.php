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

      return view('admin.agents.create', compact('pais', 'departamentos', 'ciudad', 'distrito', 'sexo'))
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

}
