<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateAgentsRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UsersAppRepository;
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

    $tpUsersApps   = User::select(DB::raw("UPPER(CONCAT(last_name,'  ', first_name)) AS name"), "users.id as id")
    ->where('isexterno',  false)
    ->orderBy('name',  'ASC')
    ->pluck( '(last_name||" " ||first_name)as name', 'users_apps.id as id');

    $pais          = Country       ::WHERE('status', '=', 'TRUE')->orderBy('country',          'ASC')->pluck('country',          'id');

    $usersApps = $this->usersAppRepository->all();

    return view('admin.agents.index')
      // ->with('usersApps',  $usersApps)
      ->with('tpUsersApps',   $tpUsersApps)
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

     if($formulario{'id_users_app'       }) { $data = $data->where('id',                  $formulario{'id_users_app'       });}
     if($formulario{'email'              }) { $data = $data->where('email', mb_strtolower($formulario{'email'              }));}
     if($formulario{'telefono'           }) { $data = $data->where('phone',               $formulario{'telefono'           });}
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

  public function store(CreateAgentsRequest $request)
  {
      $input = $request->all();
      $input{'first_name'  } = mb_strtoupper($input{'first_name'  });
      $input{'last_name'} = mb_strtoupper($input{'last_name'});
      $input{'email'    } = mb_strtolower($input{'email'    });

      $validator = Validator::make($input, [
        'email'     => 'required|unique:users_apps',
        'telefono'  => 'required|unique:users_apps'
      ]);

      if ($validator->fails()) {
          return redirect(route('agentes.create'))
                      ->withErrors($validator)
                      ->withInput();
      }

      $usersApp = $this->usersAppRepository->create($input);

      Flash::success('Agente guardado con éxito su id es '.$usersApp->id);

      return $usersApp.' '.$validator;
  }

}
