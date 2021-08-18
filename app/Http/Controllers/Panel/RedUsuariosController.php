<?php

namespace App\Http\Controllers\Panel;

use App\Http\Requests\CreateRedUsuariosRequest;
use App\Http\Requests\UpdateRedUsuariosRequest;
use App\Repositories\RedUsuariosRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\RolUsers;
use App\Models\RolMenu;
use App\Models\UsersRed;
use App\Models\StatusRed;
use App\Classes\MenuClass;
use App\Models\User;
use App\Models\Menu;
use Flash;
use Response;


/**
  * @desc: Esta clase se encarga de tarer los datos
  * @author Gloribel Delgado gdelgado.winhold@gmail.com
**/

class RedUsuariosController extends AppBaseController
{
    /** @var  RedUsuariosRepository */
    private $redUsuariosRepository;


    /** @desc: Constructor de variables globales  **/
    public function __construct(RedUsuariosRepository $redUsuariosRepo)
    {
        $this->redUsuariosRepository = $redUsuariosRepo->with('getStatusRed', 'getUsersSponsor', 'getUsersInvitado');
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
     * Display a listing of the UsersRed.
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

        $valor = $this->validPermisoMenu(25);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $redUsuarios = $this->redUsuariosRepository->all();

        return view('panel.red_usuarios.index')
            ->with('redUsuarios', $redUsuarios)
            ->with('main',        $main);
    }

    /**
     * Show the form for creating a new UsersRed.
     *
     * @return Response
     */

     /** @desc: Esta funcion se encarga de crear los datos a guardar **/
     public function create()
    {
        $main = new MenuClass();
        $main = $main->getMenu();

        $statusReds     = StatusRed   ::WHERE('status', '=', 'TRUE')->orderBy('descripcion', 'ASC'      )->pluck('descripcion',       'id');

        $usersSponsor   = User::select(DB::raw("UPPER(CONCAT(apellidos,'  ', nombres)) AS name"), "users_apps.id as id")
         ->WHERE('id_status_users_app', '!=', '1')->orderBy('name',  'ASC')
         ->pluck( '(apellidos||" " ||nombres)as name', 'users_apps.id as id');

        $usersInvitado  = User::select(DB::raw("UPPER(CONCAT(apellidos,'  ', nombres)) AS name"), "users_apps.id as id")
         ->WHERE('id_status_users_app', '!=', '1')->orderBy('name',  'ASC')
         ->pluck( '(apellidos||" " ||nombres)as name', 'users_apps.id as id');

        return view('panel.red_usuarios.create')
        ->with('main',           $main           )
        ->with('statusReds',     $statusReds     )
        ->with('usersSponsor',   $usersSponsor   )
        ->with('usersInvitado',  $usersInvitado  );
    }

    /**
     * Store a newly created UsersRed in storage.
     *
     * @param CreateRedUsuariosRequest $request
     *
     * @return Response
     */

     /** @desc: Esta funcion se encarga de guardar los datos **/
     public function store(CreateRedUsuariosRequest $request)
    {
        $input = $request->all();
        $input{'usuario_invitado'} = mb_strtoupper($input{'usuario_invitado'});

        $redUsuarios = $this->redUsuariosRepository->create($input);

        Flash::success('Red Usuarios guardados con éxito.');

        return redirect(route('red-usuarios.index'));
    }

    /**
     * Display the specified UsersRed.
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

        $valor = $this->validPermisoMenu(25);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $redUsuarios = $this->redUsuariosRepository->find($id);

        if (empty($redUsuarios)) {
            Flash::error('Red Usuarios no encontrado');

            return redirect(route('red-usuarios.index'));
        }

        return view('panel.red_usuarios.show')
        ->with('redUsuarios', $redUsuarios)
        ->with('main',        $main);
    }

    /**
     * Show the form for editing the specified UsersRed.
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

        $valor = $this->validPermisoMenu(25);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $usersSponsor   = User::select(DB::raw("UPPER(CONCAT(apellidos,'  ', nombres)) AS name"), "users_apps.id as id")
         ->WHERE('id_status_users_app', '!=', '1')->orderBy('name',  'ASC')
         ->pluck( '(apellidos||" " ||nombres)as name', 'users_apps.id as id');

        $usersInvitado  = User::select(DB::raw("UPPER(CONCAT(apellidos,'  ', nombres)) AS name"), "users_apps.id as id")
         ->WHERE('id_status_users_app', '!=', '1')->orderBy('name',  'ASC')
         ->pluck( '(apellidos||" " ||nombres)as name', 'users_apps.id as id');

        $statusReds    = StatusRed::WHERE('status', '=', 'TRUE')->orderBy('descripcion', 'ASC')->pluck('descripcion', 'id');

        $redUsuarios = $this->redUsuariosRepository->find($id);

        if (empty($redUsuarios)) {
            Flash::error('Red Usuarios no encontrado');

            return redirect(route('red-usuarios.index'));
        }

        return view('panel.red_usuarios.edit')
        ->with('redUsuarios',    $redUsuarios    )
        ->with('main',           $main           )
        ->with('statusReds',     $statusReds     )
        ->with('usersSponsor',   $usersSponsor   )
        ->with('usersInvitado',  $usersInvitado  );
    }

    /**
     * Update the specified UsersRed in storage.
     *
     * @param int $id
     * @param UpdateRedUsuariosRequest $request
     *
     * @return Response
     */

   /** @desc: Esta funcion se encarga de actualizar los datos guardados **/
   public function update($id, UpdateRedUsuariosRequest $request)
    {
        $redUsuarios = $this->redUsuariosRepository->find($id);

        if (empty($redUsuarios)) {
            Flash::error('Red Usuarios no encontrado');

            return redirect(route('red-usuarios.index'));
        }
        $input = $request->all();
        $input{'usuario_invitado'} = mb_strtoupper($input{'usuario_invitado'});

        $redUsuarios = $this->redUsuariosRepository->update($input, $id);

        Flash::success('Red Usuarios actualizado con éxito.');

        return redirect(route('red-usuarios.index'));
    }

    /**
     * Remove the specified UsersRed from storage.
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
        $redUsuarios = $this->redUsuariosRepository->find($id);

        if (empty($redUsuarios)) {
            Flash::error('Red Usuarios no encontardo');

            return redirect(route('red-usuarios.index'));
        }

        $this->redUsuariosRepository->delete($id);

        Flash::success('Red Usuarios eliminado exitosamente.');

        return redirect(route('red-usuarios.index'));
    }

    /** @funcion: Se encarga de obtener los datos.**/
    public function getRedUsuarios(Request $request)
    {
       ini_set('memory_limit','-1');

       $formulario = request()->formulario;

       $data = (new UsersRed)->newQuery()->with('getStatusRed', 'getUsersSponsor', 'getUsersInvitado', 'getUsersSponsorCodigo');
       $data = $data->get();

       return response()->json([
         'data' => $data,
       ]);
    }

    /** @desc: Esta funcion se encarga de actualizar estatus **/
    public function updateStatus()
    {
      $id        = request()->id;
      $statusUpd = UsersRed::find($id);
      $statusUpd ->status  = ($statusUpd ->status == 1)?  0 : 1;
      $statusUpd ->update();
      return response()->json([
        'object' => 'success',
      ]);
    }

}
