<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateStatusSessionRequest;
use App\Http\Requests\UpdateStatusSessionRequest;
use App\Repositories\StatusSessionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\RolUsers;
use App\Models\RolMenu;
use App\Models\StatusSession;
use App\Classes\MenuClass;
use App\Models\Menu;
use Flash;
use Response;


/**
  * @desc: Esta clase se encarga de tarer los datos
  * @author Gloribel Delgado gdelgado.winhold@gmail.com
**/

class StatusSessionController extends AppBaseController
{
    /** @var  StatusSessionRepository */
    private $statusSessionRepository;

    /** @desc: Constructor de variables globales  **/
    public function __construct(StatusSessionRepository $statusSessionRepo)
    {
        $this->statusSessionRepository = $statusSessionRepo;
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
     * Display a listing of the StatusSession.
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

        $valor = $this->validPermisoMenu(13);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $statusSessions = $this->statusSessionRepository->all();

        return view('admin.status_sessions.index')
               ->with('statusSessions', $statusSessions)
               ->with('main',           $main);
    }

    /**
     * Show the form for creating a new StatusSession.
     *
     * @return Response
     */

    /** @desc: Esta funcion se encarga de crear los datos a guardar **/
    public function create()
    {
       $main = new MenuClass();
       $main = $main->getMenu();

        return view('admin.status_sessions.create')
        ->with('main',   $main);
    }

    /**
     * Store a newly created StatusSession in storage.
     *
     * @param CreateStatusSessionRequest $request
     *
     * @return Response
     */

    /** @desc: Esta funcion se encarga de guardar los datos **/
    public function store(CreateStatusSessionRequest $request)
    {
        $input = $request->all();
        $input{'status_session'} = mb_strtoupper($input{'status_session'});

        $statusSession = $this->statusSessionRepository->create($input);

        Flash::success('Estatus Sesión guardada con éxito.');

        return redirect(route('estatus'));
    }

    /**
     * Display the specified StatusSession.
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

        $valor = $this->validPermisoMenu(13);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $statusSession = $this->statusSessionRepository->find($id);

        if (empty($statusSession)) {
            Flash::error('Estatus Sesión no encontrada');

            return redirect(route('estatus-sesion.index'));
        }

        return view('admin.status_sessions.show')
        ->with('statusSession', $statusSession)
        ->with('main',          $main);
    }

    /**
     * Show the form for editing the specified StatusSession.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $main = new MenuClass();
        $main = $main->getMenu();

        /** @desc: Esta funcion se encraga de editar los datos guardados **/
        $valor = $this->validPermisoMenu(13);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $statusSession = $this->statusSessionRepository->find($id);

        if (empty($statusSession)) {
            Flash::error('Estatus Sesión no encontrada');

            return redirect(route('estatus-sesion.index'));
        }

        return view('admin.status_sessions.edit')
        ->with('statusSession', $statusSession)
        ->with('main',          $main);
    }

    /**
     * Update the specified StatusSession in storage.
     *
     * @param int $id
     * @param UpdateStatusSessionRequest $request
     *
     * @return Response
     */

    /** @desc: Esta funcion se encarga de actualizar los datos guardados **/
    public function update($id, UpdateStatusSessionRequest $request)
    {
        $statusSession = $this->statusSessionRepository->find($id);

        if (empty($statusSession)) {
            Flash::error('Estatus Sesión no encontrada');

            return redirect(route('estatus-sesion.index'));
        }
        $input = $request->all();
        $input{'status_session'} = mb_strtoupper($input{'status_session'});

        $statusSession = $this->statusSessionRepository->update($input, $id);

        Flash::success('Estatus Sesión actualizada con éxito.');

        return redirect(route('estatus'));
    }

    /**
     * Remove the specified StatusSession from storage.
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
        $statusSession = $this->statusSessionRepository->find($id);

        if (empty($statusSession)) {
            Flash::error('Estatus Sesión no encontrada');

            return redirect(route('estatus-sesion.index'));
        }

        $this->statusSessionRepository->delete($id);

        Flash::success('Estatus Sesión eliminadas exitosamente.');

        return redirect(route('estatus-sesion.index'));
    }

    /** @funcion: Se encarga de obtener los datos.**/
    public function getStatusSession(Request $request)
    {
       ini_set('memory_limit','-1');

       $formulario = request()->formulario;
       $data       = (new StatusSession)->newQuery();
       $data       = $data->get();

       return response()->json([
         'data' => $data,
       ]);
    }

    /** @desc: Esta funcion se encarga de actualizar estatus **/
    public function updateStatus()
    {
      $id        = request()->id;
      $statusUpd = StatusSession::find($id);
      $statusUpd ->status  = ($statusUpd ->status == 1)?  0 : 1;
      $statusUpd ->update();
      return response()->json([
        'object' => 'success',
      ]);
    }
}
