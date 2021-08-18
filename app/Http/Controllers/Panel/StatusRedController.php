<?php

namespace App\Http\Controllers\Panel;

use App\Http\Requests\CreateStatusRedRequest;
use App\Http\Requests\UpdateStatusRedRequest;
use App\Repositories\StatusRedRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\RolUsers;
use App\Models\RolMenu;
use App\Models\StatusRed;
use App\Classes\MenuClass;
use App\Models\Menu;
use Flash;
use Response;


/**
  * @desc: Esta clase se encarga de tarer los datos
  * @author Gloribel Delgado gdelgado.winhold@gmail.com
**/

class StatusRedController extends AppBaseController
{
    /** @var  StatusRedRepository */
    private $statusRedRepository;

    /** @desc: Constructor de variables globales  **/
    public function __construct(StatusRedRepository $statusRedRepo)
    {
        $this->statusRedRepository = $statusRedRepo;
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
     * Display a listing of the StatusRed.
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

        $valor = $this->validPermisoMenu(24);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $statusReds = $this->statusRedRepository->all();

        return view('panel.status_reds.index')
            ->with('statusReds', $statusReds)
            ->with('main',       $main);
    }

    /**
     * Show the form for creating a new StatusRed.
     *
     * @return Response
     */

     /** @desc: Esta funcion se encarga de crear los datos a guardar **/
    public function create()
    {
        $main = new MenuClass();
        $main = $main->getMenu();

        return view('panel.status_reds.create')
        ->with('main',      $main);
    }

    /**
     * Store a newly created StatusRed in storage.
     *
     * @param CreateStatusRedRequest $request
     *
     * @return Response
     */

     /** @desc: Esta funcion se encarga de guardar los datos **/
    public function store(CreateStatusRedRequest $request)
    {
        $input = $request->all();
        $input{'descripcion'} = mb_strtoupper($input{'descripcion'});

        //INICIO PASO 2
        $validator = Validator::make($input, [
          //tp_sexos es la tabla.
          'descripcion' => 'required|unique:status_reds',
        ]);

        if ($validator->fails()) {

            return redirect(route('estatus-red.create'))
              ->withErrors($validator)
              ->withInput();
        }
        //FIN PASO 2

        $statusRed = $this->statusRedRepository->create($input);

        Flash::success('Estatus Red guardado exitosamente.');

        // return redirect(route('estatus-red.index'));
        return redirect(route('estatus'));

    }

    /**
     * Display the specified StatusRed.
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

        $valor = $this->validPermisoMenu(24);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $statusRed = $this->statusRedRepository->find($id);

        if (empty($statusRed)) {
            Flash::error('Estatus Red no encontrado');

            return redirect(route('estatus-red.index'));
        }

        return view('panel.status_reds.show')
        ->with('statusRed', $statusRed)
        ->with('main',      $main);
    }

    /**
     * Show the form for editing the specified StatusRed.
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

        $valor = $this->validPermisoMenu(24);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $statusRed = $this->statusRedRepository->find($id);

        if (empty($statusRed)) {
            Flash::error('Estatus Red no encontrado');

            return redirect(route('estatus-red.index'));
        }

        return view('panel.status_reds.edit')
        ->with('statusRed', $statusRed)
        ->with('main',      $main);
    }

    /**
     * Update the specified StatusRed in storage.
     *
     * @param int $id
     * @param UpdateStatusRedRequest $request
     *
     * @return Response
     */

     /** @desc: Esta funcion se encarga de actualizar los datos guardados **/
    public function update($id, UpdateStatusRedRequest $request)
    {
        $statusRed = $this->statusRedRepository->find($id);

        if (empty($statusRed)) {
            Flash::error('Estatus Red no encontrado');

            return redirect(route('estatus-red.index'));
        }
        $input = $request->all();
        $input{'descripcion'} = mb_strtoupper($input{'descripcion'});

        // INICIO PASO 3
        $validator = Validator::make($input, [
          //AGREGAMOS ID
            'descripcion' => 'required|unique:status_reds,descripcion,'.$id,
        ]);

        if ($validator->fails()) {
            return redirect(route('estatus-red.create'))
              ->withErrors($validator)
              ->withInput();
        }
        // FIN PASO 3

        $statusRed = $this->statusRedRepository->update($input, $id);

        Flash::success('Estatus Red actualizado exitosamente.');

        // return redirect(route('estatus-red.index'));
        return redirect(route('estatus'));

    }

    /**
     * Remove the specified StatusRed from storage.
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
        $statusRed = $this->statusRedRepository->find($id);

        if (empty($statusRed)) {
            Flash::error('Estatus Red no encontrado');

            return redirect(route('estatus-red.index'));
        }

        $this->statusRedRepository->delete($id);

        Flash::success('Estatus Red eliminado exitosamente.');

        return redirect(route('estatus-red.index'));
    }

    /** @funcion: Se encarga de obtener los datos.**/
    public function getStatusRed(Request $request)
    {
       ini_set('memory_limit','-1');

       $formulario = request()->formulario;

       $data = (new StatusRed)->newQuery();
       $data = $data->get();

       return response()->json([
         'data' => $data,
       ]);
    }


    /** @desc: Esta funcion se encarga de actualizar estatus **/
    public function updateStatus()
    {
      $id        = request()->id;
      $statusUpd = StatusRed::find($id);
      $statusUpd ->status  = ($statusUpd ->status == 1)?  0 : 1;
      $statusUpd ->update();
      return response()->json([
        'object' => 'success',
      ]);
    }

  }
