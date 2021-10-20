<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateUsersAppRequest;
use App\Http\Requests\UpdateUsersAppRequest;
use Illuminate\Support\Facades\DB;
use App\Repositories\UsersAppRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Models\RolUsers;
use App\Models\RolMenu;
use App\Models\Departament;
use App\Models\Country;
use App\Models\City;
use App\Models\Distrito;
use App\Models\TpSexo;
use App\Models\StatusUsersApp;
use App\Classes\MenuClass;
use App\Models\Session;
use App\Models\Menu;
use App\Models\UsersRed;
use App\User;
use Flash;
use Response;

class UsersAppController extends AppBaseController
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

    /**
     * Display a listing of the User.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
      $main = new MenuClass();
      $main = $main->getMenu();

      $valor = $this->validPermisoMenu(15);
      if ($valor == false){
        return view('errors.403', compact('main'));
      }

      $estatus_users = StatusUsersApp::WHERE('status', '=', true)->orderBy('status_users_app', 'ASC')->pluck('status_users_app', 'id');
      $pais          = Country       ::WHERE('status', '=', true)->orderBy('country',          'ASC')->pluck('country',          'id');

        return view('admin.users_apps.index')
        ->with('estatus_users', $estatus_users)
        ->with('pais',          $pais)
        ->with('main',          $main);

    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        $main = new MenuClass();
        $main = $main->getMenu();
        $usersApp = null;

        // $valor = $this->validPermisoMenu(15);
        // if ($valor == false){
          return view('errors.403', compact('main'));
        // }
        //
        // $pais           = Country       ::WHERE('status', '=', true)->orderBy('country',          'ASC')->pluck('country',          'id');
        // $departamentos  = Departament   ::WHERE('status', '=', true)->orderBy('departament',      'ASC')->pluck('departament',      'id');
        // $ciudad         = City          ::WHERE('status', '=', true)->orderBy('city',             'ASC')->pluck('city',             'id');
        // $distrito       = Distrito      ::WHERE('status', '=', true)->orderBy('distrito',         'ASC')->pluck('distrito',         'id');
        // $sexo           = TpSexo        ::WHERE('status', '=', true)->orderBy('descripcion',      'ASC')->pluck('descripcion',      'id');
        // $estatus_users  = StatusUsersApp::WHERE('status', '=', true)->orderBy('status_users_app', 'ASC')->pluck('status_users_app', 'id');
        //
        // return view('admin.users_apps.create', compact('pais', 'departamentos', 'ciudad', 'distrito', 'sexo', 'estatus_users'))
        // ->with('main',     $main)
        // ->with('usersApp', $usersApp);
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUsersAppRequest $request
     *
     * @return Response
     */
    public function store(CreateUsersAppRequest $request)
    {
        $input = $request->all();
        $input{'first_name'  } = mb_strtoupper($input{'first_name'  });
        $input{'last_name'} = mb_strtoupper($input{'last_name'});
        $input{'email'    } = mb_strtolower($input{'email'    });

        $validator = Validator::make($input, [
          'email'     => 'required|unique:users',
          'phone'  => 'required|unique:users'
        ]);

        if ($validator->fails()) {
            return redirect(route('usuarios-app.create'))
                        ->withErrors($validator)
                        ->withInput();
        }

        $usersApp = $this->usersAppRepository->create($input);

        // Flash::success('Usuario guardado con éxito.');

        return redirect(route('usuarios-app.index'));
    }

    /**
     * Display the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $main = new MenuClass();
        $main = $main->getMenu();

        $valor = $this->validPermisoMenu(15);
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $usersApp = $this->usersAppRepository->find($id);
        $u_r = UsersRed::where('id_users',$id)->first();
        $u_s = UsersRed::where('id_users',$u_r->id_users_sponsor)->first();

        if (empty($usersApp)) {
            // Flash::error('Usuario no encontrado');
            return redirect(route('usuarios-app.index'));
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

        return view('admin.users_apps.show')
        ->with('user', $u_r)
        ->with('sponsor', $u_s)
        ->with('usersApp', $usersApp)
        ->with('main',     $main);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
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

        $usersApp = $this->usersAppRepository->find($id);

        if (empty($usersApp)) {
            // Flash::error('Usuario no encontrado');
            return redirect(route('usuarios-app.index'));
        }

        return view('admin.users_apps.edit')
        ->with ('usersApp',      $usersApp)
        ->with ('pais',          $pais)
        ->with ('departamentos', $departamentos)
        ->with ('ciudad',        $ciudad)
        ->with ('distrito',      $distrito)
        ->with ('sexo',          $sexo)
        ->with ('estatus_users', $estatus_users)
        ->with ('main',          $main);

    }

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param UpdateUsersAppRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUsersAppRequest $request)
    {
        $usersApp = $this->usersAppRepository->find($id);

        if (empty($usersApp)) {
            // Flash::error('Usuario no encontrado');

            return redirect(route('usuarios-app.index'));
        }
                $input = $request->all();
                $input{'first_name'  } = mb_strtoupper($input{'first_name'  });
                $input{'last_name'}    = mb_strtoupper($input{'last_name'});
                $input{'email'    }    = mb_strtolower($input{'email'    });

                $validator = Validator::make($input, [

                    'email'    => 'required|unique:users,email,'.$id,
                    'phone'    => 'required|unique:users,phone,'.$id
                ]);

                if ($validator->fails()) {
                    return redirect(route('usuarios-app.create'))
                                ->withErrors($validator)
                                ->withInput();
                }

                $usersApp = $this->usersAppRepository->update($input, $id);

        // Flash::success('Usuario actualizado correctamente.');

        return redirect(route('usuarios-app.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $usersApp = $this->usersAppRepository->find($id);

        if (empty($usersApp)) {
            // Flash::error('Usuario no encontrado');

            return redirect(route('usuarios-app.index'));
        }

        $this->usersAppRepository->delete($id);

        // Flash::success('Usuario eliminado correctamente.');

        return redirect(route('usuarios-app.index'));
    }

    public function getUsersApps(Request $request)
    {
       ini_set('memory_limit','-1');

       $formulario    = request()->formulario;

       $data = (new User)->newQuery()->with(
                           'getSexo',
                           'getCountry',
                           'getDepartament',
                           'getStatusUsersApp'
                                      );

       if($formulario{'name'}) {
        
            $u = UsersRed::where('username','like', '%' .$formulario['name'].'%')->get();
        // return response()->json([$u]);
        $ar_id = [];

        foreach ($u as $key => $value) {
          array_push($ar_id,$value->id_users);
        }
        
        $data = $data->whereIn('id',$ar_id );
        // $data = $data->orWhere('first_name', 'like', '%' .mb_strtoupper($formulario{'name'}) . '%')->get();
        //  $data = $data->orWhere('last_name', 'like', '%' .mb_strtoupper($formulario{'name'} ). '%');
        //  $data = $data->orWhere('middle_name', 'like', '%' .mb_strtoupper($formulario{'name'}) . '%');

       }
       if($formulario{'full_name'              }) { 
         $data = $data->orWhere('first_name', 'like', '%' .mb_strtoupper($formulario{'full_name'}) . '%');
         $data = $data->orWhere('last_name', 'like', '%' .mb_strtoupper($formulario{'full_name'} ). '%');
         $data = $data->orWhere('middle_name', 'like', '%' .mb_strtoupper($formulario{'full_name'}) . '%');
        }
       if($formulario{'email'              }) { $data = $data->where('email', mb_strtolower($formulario{'email'              }));}
       if($formulario{'phone'              }) { $data = $data->where('phone',               $formulario{'phone'           });}
       if($formulario{'id_country'         }) { $data = $data->where('id_country',          $formulario{'id_country'         });}
       if($formulario{'id_status_users_app'}) { $data = $data->where('id_status_users_app', $formulario{'id_status_users_app'});}

       $data = $data->where('isexterno',  true);

       $data = $data->get();

       return response()->json([
         'data' => $data,
       ]);
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


    public function updateBloqueoAcceso ()
    {
      $id        = request()->id;
      $accesoUpd = User::find($id);
      $accesoUpd ->id_status_users_app  = ($accesoUpd ->id_status_users_app == 3 )?
      ($accesoUpd ->first_name  && $accesoUpd ->last_name)? 2 : 1
      : 3;
      $accesoUpd ->update();
      return response()->json([
        'object' => 'success',
      ]);
    }
}
