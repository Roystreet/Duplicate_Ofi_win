<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateStatusUsersAppRequest;
use App\Http\Requests\UpdateStatusUsersAppRequest;
use App\Repositories\StatusUsersAppRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\RolUsers;
use App\Models\RolMenu;
use App\Models\StatusUsersApp;
use App\Classes\MenuClass;
use App\Models\Menu;
use Flash;
use Response;


/**
  * @desc: Esta clase se encarga de tarer los datos
  * @author Gloribel Delgado gdelgado.winhold@gmail.com
**/

class StatusUsersAppController extends AppBaseController
{
    /** @var  StatusUsersAppRepository */
    private $statusUsersAppRepository;


    /** @desc: Constructor de variables globales  **/
    public function __construct(StatusUsersAppRepository $statusUsersAppRepo)
    {
        $this->statusUsersAppRepository = $statusUsersAppRepo;
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
     * Display a listing of the StatusUsersApp.
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

        $valor = $this->validPermisoMenu(12);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $statusUsersApps = $this->statusUsersAppRepository->all();

        return view('admin.status_users_apps.index')
            ->with('statusUsersApps', $statusUsersApps)
            ->with('main',            $main);
    }

    /**
     * Show the form for creating a new StatusUsersApp.
     *
     * @return Response
     */

     /** @desc: Esta funcion se encarga de crear los datos a guardar **/
    public function create()
    {
        $main = new MenuClass();
        $main = $main->getMenu();

        return view('admin.status_users_apps.create')
        ->with('main',   $main);
    }

    /**
     * Store a newly created StatusUsersApp in storage.
     *
     * @param CreateStatusUsersAppRequest $request
     *
     * @return Response
     */

     /** @desc: Esta funcion se encarga de guardar los datos **/
    public function store(CreateStatusUsersAppRequest $request)
    {
        $input = $request->all();
        $input{'status_users_app'} = mb_strtoupper($input{'status_users_app'});

        $validator = Validator::make($input, [

          'status_users_app' => 'required|unique:status_users_apps',
        ]);

        if ($validator->fails()) {

            return redirect(route('estatus-usuarios-app.create'))
              ->withErrors($validator)
              ->withInput();
        }

        $statusUsersApp = $this->statusUsersAppRepository->create($input);

        Flash::success('Estado usuarios APP se ha guardado correctamente');

        return redirect(route('estatus'));
    }

    /**
     * Display the specified StatusUsersApp.
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

        $valor = $this->validPermisoMenu(12);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $statusUsersApp = $this->statusUsersAppRepository->find($id);

        if (empty($statusUsersApp)) {
            Flash::error('Estado usuarios APP no encontrada');

            return redirect(route('estatus-usuarios-app.index'));
        }

        return view('admin.status_users_apps.show')
        ->with('statusUsersApp', $statusUsersApp)
        ->with('main',           $main);

    }

    /**
     * Show the form for editing the specified StatusUsersApp.
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

        $valor = $this->validPermisoMenu(12);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $statusUsersApp = $this->statusUsersAppRepository->find($id);

        if (empty($statusUsersApp)) {
            Flash::error('Estado usuarios APP no encontrada');

            return redirect(route('estatus-usuarios-app.index'));
        }

        return view('admin.status_users_apps.edit')
        ->with('statusUsersApp', $statusUsersApp)
        ->with('main',           $main);
    }

    /**
     * Update the specified StatusUsersApp in storage.
     *
     * @param int $id
     * @param UpdateStatusUsersAppRequest $request
     *
     * @return Response
     */

     /** @desc: Esta funcion se encarga de actualizar los datos guardados **/
    public function update($id, UpdateStatusUsersAppRequest $request)
    {
        $statusUsersApp = $this->statusUsersAppRepository->find($id);

        if (empty($statusUsersApp)) {
            Flash::error('Estado usuarios APP no encontrada');

            return redirect(route('estatus-usuarios-app.index'));
        }
        $input = $request->all();
        $input{'status_users_app'} = mb_strtoupper($input{'status_users_app'});

        $validator = Validator::make($input, [
          //AGREGAMOS ID
            'status_users_app' => 'required|unique:status_users_apps,status_users_app,'.$id,
        ]);

        if ($validator->fails()) {
            return redirect(route('estatus'))
              ->withErrors($validator)
              ->withInput();
        }

        $statusUsersApp = $this->statusUsersAppRepository->update($input, $id);

        Flash::success('Estado usuarios APP actualizada correctamente');

        return redirect(route('estatus-usuarios-app.index'));
    }

    /**
     * Remove the specified StatusUsersApp from storage.
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
        $statusUsersApp = $this->statusUsersAppRepository->find($id);

        if (empty($statusUsersApp)) {
            Flash::error('Estado usuarios APP no encontrada');

            return redirect(route('estatus-usuarios-app.index'));
        }

        $this->statusUsersAppRepository->delete($id);

        Flash::success('Estado usuarios APP se eliminó correctamente');

        return redirect(route('estatus-usuarios-app.index'));
    }

    /** @funcion: Se encarga de obtener los datos.**/
    public function getStatusUsersApp(Request $request)
        {
           ini_set('memory_limit','-1');

           $formulario    = request()->formulario;

           $data = (new StatusUsersApp)->newQuery();
           $data = $data->get();

           return response()->json([
             'data' => $data,
           ]);
        }

        /** @desc: Esta funcion se encarga de actualizar estatus **/
        public function updateStatus()
            {
              $id        = request()->id;
              $statusUpd = StatusUsersApp::find($id);
              $statusUpd ->status  = ($statusUpd ->status == 1)?  0 : 1;
              $statusUpd ->update();
              return response()->json([
                'object' => 'success',
              ]);
            }
}
