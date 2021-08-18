<?php

namespace App\Http\Controllers\Panel;

use App\Http\Requests\CreatePasswordUsersAppRequest;
use App\Http\Requests\UpdatePasswordUsersAppRequest;
use App\Repositories\PasswordUsersAppRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\RolUsers;
use App\Models\RolMenu;
use App\Models\User;
use App\Models\UsersPasswords;
use App\Classes\MenuClass;
use App\Models\Menu;
use Flash;
use Response;


/**
  * @desc: Esta clase se encarga de tarer los datos
  * @author Gloribel Delgado gdelgado.winhold@gmail.com
**/

class PasswordUsersAppController extends AppBaseController
{
    /** @var  PasswordUsersAppRepository */
    private $passwordUsersAppRepository;

    /** @desc: Constructor de variables globales  **/
    public function __construct(PasswordUsersAppRepository $passwordUsersAppRepo)
    {
        $this->passwordUsersAppRepository = $passwordUsersAppRepo->with('getUsersApp');
    }

    /** @funcion: Se encarga de validar que el usuario tenga permiso en el menu  **/
    public function validPermisoMenu($id_menu) {

      $roles = RolUsers::where('id_user', auth()->user()->id)->get();
      foreach ($roles as $key) {
        /** @desc: Rol -> 1 SuperUser , acceso a todos los menu. **/
        if($key->id_tp_rol == 1){
          return true;
        }
        /** Validamos que el rol contenga el menu disponible **/
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
     * Display a listing of the UsersPasswords.
     *
     * @param Request $request
     *
     * @return Response
     */

     /** @funcion: Vista del listado de consultas realizadas.**/
     public function index(Request $request)
    {
        $main = new MenuClass();
        $main = $main->getMenu();

        $valor = $this->validPermisoMenu(16);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $passwordUsersApps = $this->passwordUsersAppRepository->all();

        return view('panel.password_users_apps.index')
            ->with('passwordUsersApps', $passwordUsersApps)
            ->with('main',              $main);
    }

    /**
     * Show the form for creating a new UsersPasswords.
     *
     * @return Response
     */

     /** @desc: Esta funcion se encarga de crear los datos a guardar **/
     public function create()
    {
      $main = new MenuClass();
      $main = $main->getMenu();

      $tpUsersAps = User::select(DB::raw("UPPER(CONCAT(apellidos,'  ', nombres)) AS name"), "users_apps.id as id")
       ->orderBy('name',  'ASC')
       ->pluck( '(apellidos||" " ||nombres)as name', 'users_apps.id as id');

        return view('panel.password_users_apps.create')
        ->with('tpUsersAps', $tpUsersAps)
        ->with('main',       $main);
    }

    /**
     * Store a newly created UsersPasswords in storage.
     *
     * @param CreatePasswordUsersAppRequest $request
     *
     * @return Response
     */

     /** @desc: Esta funcion se encarga de mostrar los detalles de un usuario especifo **/
     public function store(CreatePasswordUsersAppRequest $request)
    {
        $input = $request->all();

        $passwordUsersApp = $this->passwordUsersAppRepository->create($input);

        Flash::success('Contraseña Usuarios guardada correctamente.');

        return redirect(route('clave-usuarios-app.index'));
    }

    /**
     * Display the specified UsersPasswords.
     *
     * @param int $id
     *
     * @return Response
     */

     /** @desc: Esta funcion se encarga de mostrar los detalles de un usuario especifo **/
     public function show($id)
    {
        $main = new MenuClass();
        $main = $main->getMenu();

        $valor = $this->validPermisoMenu(16);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $passwordUsersApp = $this->passwordUsersAppRepository->find($id);

        if (empty($passwordUsersApp)) {
            Flash::error('Contraseña Usuarios no encontrada');

            return redirect(route('clave-usuarios-app.index'));
        }

        return view('panel.password_users_apps.show')
        ->with('passwordUsersApp', $passwordUsersApp)
        ->with('main',             $main);
    }

    /**
     * Show the form for editing the specified UsersPasswords.
     *
     * @param int $id
     *
     * @return Response
     */

     /** @desc: Esta funcion se encraga de editar los datos guardados **/
     public function edit($id)
    {
        $main = new MenuClass();
        $main = $main->getMenu();

        $valor = $this->validPermisoMenu(16);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $passwordUsersApp = $this->passwordUsersAppRepository->find($id);
        $tpUsersAps       = User::select(DB::raw("UPPER(CONCAT(apellidos,'  ', nombres)) AS name"), "users_apps.id as id")
         ->orderBy('name',  'ASC')
         ->pluck( '(apellidos||" " ||nombres)as name', 'users_apps.id as id');

        if (empty($passwordUsersApp)) {
            Flash::error('Contraseña Usuarios no encontrada');

            return redirect(route('clave-usuarios-app.index'));
        }

        return view('panel.password_users_apps.edit')
        ->with('passwordUsersApp', $passwordUsersApp)
        ->with('tpUsersAps',       $tpUsersAps)
        ->with('main',             $main);
    }

    /**
     * Update the specified UsersPasswords in storage.
     *
     * @param int $id
     * @param UpdatePasswordUsersAppRequest $request
     *
     * @return Response
     */

     /** @desc: Esta funcion se encarga de actualizar los datos guardados **/
     public function update($id, UpdatePasswordUsersAppRequest $request)
    {
        $passwordUsersApp = $this->passwordUsersAppRepository->find($id);

        if (empty($passwordUsersApp)) {
            Flash::error('Contraseña Usuarios no encontrada');

            return redirect(route('clave-usuarios-app.index'));
        }

        $passwordUsersApp = $this->passwordUsersAppRepository->update($request->all(), $id);

        Flash::success('Contraseña Usuarios actualizada con éxito.');

        return redirect(route('clave-usuarios-app.index'));
    }

    /**
     * Remove the specified UsersPasswords from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */

     /** @desc: Esta funcion se encarga de eliminar datos guardados **/
     public function destroy($id)
    {
        $passwordUsersApp = $this->passwordUsersAppRepository->find($id);

        if (empty($passwordUsersApp)) {
            Flash::error('Contraseña Usuarios no encontrada');

            return redirect(route('clave-usuarios-app.index'));
        }

        $this->passwordUsersAppRepository->delete($id);

        Flash::success('Contraseña Usuarios se eliminó correctamente.');

        return redirect(route('clave-usuarios-app.index'));
    }

    /** @funcion: Se encarga de obtener los datos.**/
    public function getPasswordUsersApp(Request $request)
    {
       ini_set('memory_limit','-1');

       $formulario = request()->formulario;

       $data = (new UsersPasswords)->newQuery()->with('getUsersApp','getPasswordUsersApp');
       $data = $data->get();

       return response()->json([
         'data' => $data,
       ]);
    }

    /** @desc: Esta funcion se encarga de actualizar estatus **/
    public function updateStatus()
        {
          $id        = request()->id;
          $statusUpd = UsersPasswords::find($id);
          $statusUpd ->status  = ($statusUpd ->status == 1)?  0 : 1;
          $statusUpd ->update();
          return response()->json([
            'object' => 'success',
          ]);
        }

}
