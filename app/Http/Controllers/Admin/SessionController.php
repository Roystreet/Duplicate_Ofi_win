<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateSessionRequest;
use App\Http\Requests\UpdateSessionRequest;
use App\Repositories\SessionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\RolUsers;
use App\Models\RolMenu;
use App\Models\StatusSession;
use App\Models\Session;
use App\Classes\MenuClass;
use App\Models\Menu;
use Flash;
use Response;


/**
  * @desc: Esta clase se encarga de tarer los datos
  * @author Gloribel Delgado gdelgado.winhold@gmail.com
**/

class SessionController extends AppBaseController
{
    /** @var  SessionRepository */
    private $sessionRepository;

    /** @desc: Constructor de variables globales  **/
    public function __construct(SessionRepository $sessionRepo)
    {
        $this->sessionRepository = $sessionRepo->with('getStatusSession');
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
     * Display a listing of the Session.
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

        $valor = $this->validPermisoMenu(14);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $sessions = $this->sessionRepository->all();

        return view('admin.sessions.index')
            ->with('sessions', $sessions)
            ->with('main',     $main);
    }

    /**
     * Show the form for creating a new Session.
     *
     * @return Response
     */

     /** @desc: Esta funcion se encarga de crear los datos a guardar **/
    public function create()
    {
      $main = new MenuClass();
      $main = $main->getMenu();
      $session = null;

      $statusSessions = StatusSession::WHERE('status', '=', true)->orderBy('status_session', 'ASC')->pluck('status_session', 'id');

        return view('admin.sessions.create')
        ->with('statusSessions', $statusSessions)
        ->with('main',           $main)
        ->with('session',        $session);;
    }

    /**
     * Store a newly created Session in storage.
     *
     * @param CreateSessionRequest $request
     *
     * @return Response
     */

     /** @desc: Esta funcion se encarga de guardar los datos **/
     public function store(CreateSessionRequest $request)
    {
        $input          = $request->all();
        $input{'token'} = mb_strtoupper($input{'token'});

        $session = $this->sessionRepository->create($input);

        Flash::success('Sesión guardada con éxito.');

        return redirect(route('sesiones.index'));
    }

    /**
     * Display the specified Session.
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

        $valor = $this->validPermisoMenu(14);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $session = $this->sessionRepository->find($id);

        if (empty($session)) {
            Flash::error('Sesión no encontrada');

            return redirect(route('sesiones.index'));
        }

        return view('admin.sessions.show')
        ->with('session', $session)
        ->with('main',    $main);
    }

    /**
     * Show the form for editing the specified Session.
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

        $valor = $this->validPermisoMenu(14);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $session = $this->sessionRepository->find($id);

        $statusSessions = StatusSession::WHERE('status', '=', true)->orderBy('status_session', 'ASC')->pluck('status_session', 'id');

        if (empty($session)) {
            Flash::error('Sesión no encontrada');

            return redirect(route('sesiones.index'));
        }

        return view('admin.sessions.edit')
        ->with('session',        $session)
        ->with('statusSessions', $statusSessions)
        ->with('main',           $main);
    }

    /**
     * Update the specified Session in storage.
     *
     * @param int $id
     * @param UpdateSessionRequest $request
     *
     * @return Response
     */

    /** @desc: Esta funcion se encarga de actualizar los datos guardados **/
    public function update($id, UpdateSessionRequest $request)
    {
        $session = $this->sessionRepository->find($id);

        if (empty($session)) {
            Flash::error('Sesión no encontrada');

            return redirect(route('sesiones.index'));
        }

        $input          = $request->all();
        $input{'token'} = mb_strtoupper($input{'token'});

        $session = $this->sessionRepository->update($input, $id);

        Flash::success('Sesión actualizada con éxito.');

        return redirect(route('sesiones.index'));
    }

    /**
     * Remove the specified Session from storage.
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
        $session = $this->sessionRepository->find($id);

        if (empty($session)) {
            Flash::error('Sesión no encontrada');

            return redirect(route('sesiones.index'));
        }

        $this->sessionRepository->delete($id);

        Flash::success('Sesión eliminada con éxito.');

        return redirect(route('sesiones.index'));
    }

    /** @funcion: Se encarga de obtener los datos.**/
    public function getSession(Request $request)
    {
       ini_set('memory_limit','-1');

       $formulario = request()->formulario;
       $data       = (new Session)->newQuery()->with('getStatusSession');
       $data       = $data->get();

       return response()->json([
         'data' => $data,
       ]);
    }
}
