<?php

namespace App\Http\Controllers\Panel;

use App\Http\Requests\CreateTpSexoRequest;
use App\Http\Requests\UpdateTpSexoRequest;
use App\Repositories\TpSexoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\RolUsers;
use App\Models\RolMenu;
use App\Models\TpSexo;
use Flash;
use Response;

use App\Classes\MenuClass;
use App\Models\Menu;

class TpSexoController extends AppBaseController
{
    /** @var  TpSexoRepository */
    private $tpSexoRepository;

    public function __construct(TpSexoRepository $tpSexoRepo)
    {
      $this->tpSexoRepository = $tpSexoRepo;
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
     * Display a listing of the TpSexo.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
      $main = new MenuClass();
      $main = $main->getMenu();

      $valor = $this->validPermisoMenu(8);
      if ($valor == false){
        return view('errors.403', compact('main'));
      }

      $tpSexos = $this->tpSexoRepository->all();

        return view('panel.tp_sexos.index')
            ->with('tpSexos', $tpSexos)
            ->with('main',    $main);

    }

    /**
     * Show the form for creating a new TpSexo.
     *
     * @return Response
     */
    public function create()
    {
      $main = new MenuClass();
      $main = $main->getMenu();

        return view('panel.tp_sexos.create')
        ->with('main',    $main);
    }

    /**
     * Store a newly created TpSexo in storage.
     *
     * @param CreateTpSexoRequest $request
     *
     * @return Response
     */
    public function store(CreateTpSexoRequest $request)
    {

        $input = $request->all();
        $input{'descripcion'} = mb_strtoupper($input{'descripcion'});

        //INICIO PASO 2
        $validator = Validator::make($input, [
          //tp_sexos es la tabla.
          'descripcion' => 'required|unique:tp_sexos',
        ]);

        if ($validator->fails()) {

            return redirect(route('sexos.create'))
              ->withErrors($validator)
              ->withInput();
        }
        //FIN PASO 2


        $tpSexo = $this->tpSexoRepository->create($input);

        Flash::success('Sexo guardado con &eacute;xito.');

        return redirect(route('sexos.index'));
    }

    /**
     * Display the specified TpSexo.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
      $main = new MenuClass();
      $main = $main->getMenu();

      $valor = $this->validPermisoMenu(8);
      if ($valor == false){
        return view('errors.403', compact('main'));
      }

        $tpSexo = $this->tpSexoRepository->find($id);

        if (empty($tpSexo)) {
            Flash::error('Sexo no encontrado');

            return redirect(route('sexos.index'));
        }

        return view('panel.tp_sexos.show')
        ->with('tpSexo', $tpSexo)
        ->with('main',   $main);
    }

    /**
     * Show the form for editing the specified TpSexo.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
      $main = new MenuClass();
      $main = $main->getMenu();

      $valor = $this->validPermisoMenu(8);
      if ($valor == false){
        return view('errors.403', compact('main'));
      }

        $tpSexo = $this->tpSexoRepository->find($id);

        if (empty($tpSexo)) {
            Flash::error('Sexo no encontrado');

            return redirect(route('sexos.index'));
        }

        return view('panel.tp_sexos.edit')
        ->with('tpSexo', $tpSexo)
        ->with('main',   $main);
    }

    /**
     * Update the specified TpSexo in storage.
     *
     * @param int $id
     * @param UpdateTpSexoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTpSexoRequest $request)
    {
        $tpSexo = $this->tpSexoRepository->find($id);

        if (empty($tpSexo)) {
            Flash::error('Sexo no encontrado');

            return redirect(route('sexos.index'));
        }
        $input = $request->all();
        $input{'descripcion'} = mb_strtoupper($input{'descripcion'});

        // INICIO PASO 3
        $validator = Validator::make($input, [
          //AGREGAMOS ID
            'descripcion' => 'required|unique:tp_sexos,descripcion,'.$id,
        ]);

        if ($validator->fails()) {
            return redirect(route('sexos.create'))
              ->withErrors($validator)
              ->withInput();
        }
        // FIN PASO 3


        $tpSexo = $this->tpSexoRepository->update($input, $id);

        Flash::success('Sexo actualizado con éxito.');

        return redirect(route('sexos.index'));
    }
    /**
     * Remove the specified TpSexo from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */


    public function destroy($id)
    {
        $tpSexo = $this->tpSexoRepository->find($id);

        if (empty($tpSexo)) {
            Flash::error('Sexo no encontrado');

            return redirect(route('sexos.index'));
        }

        $this->tpSexoRepository->delete($id);

        Flash::success('Sexo eliminado con &eacute;xito.');

        return redirect(route('sexos.index'));
    }


    public function getSexo(Request $request)
    {
       ini_set('memory_limit','-1');

       $formulario = request()->formulario;

       $data = (new TpSexo)->newQuery();
       $data = $data->get();

       return response()->json([
         'data' => $data,
       ]);
    }


    public function updateStatus()
    {
      $id        = request()->id;
      $statusUpd = TpSexo::find($id);
      $statusUpd ->status  = ($statusUpd ->status == 1)?  0 : 1;
      $statusUpd ->update();
      return response()->json([
        'object' => 'success',
      ]);
    }
}
