<?php

namespace App\Http\Controllers\Panel;

use App\Http\Requests\CreateAccesosIpRequest;
use App\Http\Requests\UpdateAccesosIpRequest;
use App\Repositories\AccesosIpRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\RolUsers;
use App\Models\RolMenu;
use App\Models\AccesosIp;
use App\Classes\MenuClass;
use App\Models\Menu;
use Flash;
use Response;


/**
  * @desc: Esta clase se encarga de tarer los datos
  * @author Gloribel Delgado gdelgado.winhold@gmail.com
**/

class AccesosIpController extends AppBaseController
{
    /** @var  AccesosIpRepository */
    private $accesosIpRepository;


    /** @desc: Constructor de variables globales  **/
    public function __construct(AccesosIpRepository $accesosIpRepo)
    {
        $this->accesosIpRepository = $accesosIpRepo;
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
     * Display a listing of the AccesosIp.
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

        $valor = $this->validPermisoMenu(35);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $accesosIps = $this->accesosIpRepository->all();

        return view('panel.accesos_ips.index')
            ->with('accesosIps', $accesosIps)
            ->with('main',       $main);
    }

    /**
     * Show the form for creating a new AccesosIp.
     *
     * @return Response
     */

    /** @desc: Esta funcion se encarga de crear los datos a guardar **/
    public function create()
    {
        $main = new MenuClass();
        $main = $main->getMenu();

        return view('panel.accesos_ips.create')
        ->with('main',        $main);
    }

    /**
     * Store a newly created AccesosIp in storage.
     *
     * @param CreateAccesosIpRequest $request
     *
     * @return Response
     */

    /** @desc: Esta funcion se encarga de guardar los datos **/
    public function store(CreateAccesosIpRequest $request)
    {
        $input = $request->all();

        $accesosIp = $this->accesosIpRepository->create($input);

        Flash::success('Accesos IP guardado exitosamente.');

        return redirect(route('accesos-ip.index'));
    }

    /**
     * Display the specified AccesosIp.
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

        $valor = $this->validPermisoMenu(35);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $accesosIp = $this->accesosIpRepository->find($id);

        if (empty($accesosIp)) {
            Flash::error('Accesos IP no encontrado');

            return redirect(route('accesos-ip.index'));
        }

        return view('panel.accesos_ips.show')
        ->with('accesosIp', $accesosIp)
        ->with('main',      $main);
    }

    /**
     * Show the form for editing the specified AccesosIp.
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

        $valor = $this->validPermisoMenu(35);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $accesosIp = $this->accesosIpRepository->find($id);

        if (empty($accesosIp)) {
            Flash::error('Accesos IP no encontrado');

            return redirect(route('accesos-ip.index'));
        }

        return view('panel.accesos_ips.edit')
        ->with('accesosIp', $accesosIp)
        ->with('main',      $main);
    }

    /**
     * Update the specified AccesosIp in storage.
     *
     * @param int $id
     * @param UpdateAccesosIpRequest $request
     *
     * @return Response
     */

    /** @desc: Esta funcion se encarga de actualizar los datos guardados **/
    public function update($id, UpdateAccesosIpRequest $request)
    {
        $accesosIp = $this->accesosIpRepository->find($id);

        if (empty($accesosIp)) {
            Flash::error('Accesos IP no encontrado');

            return redirect(
              ('accesosIps.index'));
        }

        $accesosIp = $this->accesosIpRepository->update($request->all(), $id);

        Flash::success('Accesos IP actualizado exitosamente.');

        return redirect(route('accesos-ip.index'));
    }

    /**
     * Remove the specified AccesosIp from storage.
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
        $accesosIp = $this->accesosIpRepository->find($id);

        if (empty($accesosIp)) {
            Flash::error('Accesos IP no encontrado');

            return redirect(route('accesos-ip.index'));
        }

        $this->accesosIpRepository->delete($id);

        Flash::success('Accesos IP eliminado exitosamente.');

        return redirect(route('accesos-ip.index'));
    }

    /** @funcion: Se encarga de obtener los datos.**/
    public function getAccesosIp(Request $request)
    {
       ini_set('memory_limit','-1');

       $formulario = request()->formulario;

       $data = (new AccesosIp)->newQuery();
       $data = $data->get();

       return response()->json([
         'data' => $data,
       ]);
    }

    /** @desc: Esta funcion se encarga de actualizar estatus **/
    public function updateStatus()
    {
      $id        = request()->id;
      $statusUpd = AccesosIp::find($id);
      $statusUpd ->status  = ($statusUpd ->status == 1)?  0 : 1;
      $statusUpd ->update();
      return response()->json([
        'object' => 'success',
      ]);
    }
}
