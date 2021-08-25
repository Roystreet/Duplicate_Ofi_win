<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateDistritoRequest;
use App\Http\Requests\UpdateDistritoRequest;
use App\Repositories\DistritoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Distrito;
use App\Models\City;
use App\Classes\MenuClass;
use App\Models\Menu;
use Flash;
use Response;



/**
  * @desc: Esta clase se encarga de tarer los datos
  * @author Gloribel Delgado gdelgado.winhold@gmail.com
**/

class DistritoController extends AppBaseController
{
    /** @var  DistritoRepository */
    private $distritoRepository;

    /** @desc: Constructor de variables globales  **/
    public function __construct(DistritoRepository $distritoRepo)
    {
        $this->distritoRepository = $distritoRepo;
    }

    /**
     * Display a listing of the Distrito.
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

        $distrito = $this->distritoRepository->all();

        return view('admin.distritos.index')
            ->with('distrito', $distrito)
            ->with('main',      $main);
    }

    /**
     * Show the form for creating a new Distrito.
     *
     * @return Response
     */

     /** @desc: Esta funcion se encarga de crear los datos a guardar **/
     public function create()
    {
        $main = new MenuClass();
        $main = $main->getMenu();

        $city = City::WHERE('status', '=', 'TRUE')->orderBy('city', 'ASC')->pluck('city', 'id');

        return view('admin.distritos.create')
        ->with('city',      $city)
        ->with('main',      $main);
    }

    /**
     * Store a newly created Distrito in storage.
     *
     * @param CreateDistritoRequest $request
     *
     * @return Response
     */

     /** @desc: Esta funcion se encarga de guardar los datos **/
     public function store(CreateDistritoRequest $request)
    {
        $input = $request->all();
        $input{'distrito'} = mb_strtoupper($input{'distrito'});

        $distrito = $this->distritoRepository->create($input);

        Flash::success('Distrito guardado exitosamente.');

        return redirect(route('distritos.index'));
    }

    /**
     * Display the specified Distrito.
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

        $distrito = $this->distritoRepository->find($id);

        if (empty($distrito)) {
            Flash::error('Distrito no encontrado');

            return redirect(route('distritos.index'));
        }

        return view('admin.distritos.show')
        ->with('distrito', $distrito)
        ->with('main', $main);
    }

    /**
     * Show the form for editing the specified Distrito.
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

        $city = City::WHERE('status', '=', 'TRUE')->orderBy('city', 'ASC')->pluck('city', 'id');
        $distrito = $this->distritoRepository->find($id);

        if (empty($distrito)) {
            Flash::error('Distrito no encontrado');

            return redirect(route('distritos.index'));
        }

        return view('admin.distritos.edit')
        ->with('city', $city)
        ->with('distrito', $distrito)
        ->with('main',     $main);
    }

    /**
     * Update the specified Distrito in storage.
     *
     * @param int $id
     * @param UpdateDistritoRequest $request
     *
     * @return Response
     */

    /** @desc: Esta funcion se encarga de actualizar los datos guardados **/
    public function update($id, UpdateDistritoRequest $request)
    {
        $distrito = $this->distritoRepository->find($id);

        if (empty($distrito)) {
            Flash::error('Distrito no encontrado');

            return redirect(route('distritos.index'));
        }
        $input = $request->all();
        $input{'distrito'} = mb_strtoupper($input{'distrito'});

        $distrito = $this->distritoRepository->update($input, $id);

        Flash::success('Distrito actualizado exitosamente.');

        return redirect(route('distritos.index'));
    }

    /**
     * Remove the specified Distrito from storage.
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
        $distrito = $this->distritoRepository->find($id);

        if (empty($distrito)) {
            Flash::error('Distrito no encontrado');

            return redirect(route('distritos.index'));
        }

        $this->distritoRepository->delete($id);

        Flash::success('Distrito eliminado exitosamente.');

        return redirect(route('distritos.index'));
    }

    /** @desc: Esta funcion se encarga de buscar datos **/
    public function get($id)
    {
        if (!$id) {
            $html  = '<option value="">'.trans('Seleccione un distrito...').'</option>';
        } else {
            $html  = '<option selected="selected" value="">Seleccione un distrito...</option>';
            $datos = Distrito::where('status', '=', 'TRUE')->where('id_city', $id)->get();
            foreach ($datos as $dato) {
            $html .= '<option value="'.$dato->id.'">'.$dato->distrito.'</option>';
            }
        }

        return response()->json(['html' => $html]);
    }

    /** @funcion: Se encarga de obtener los datos.**/
    public function getDistritos(Request $request)
        {
           ini_set('memory_limit','-1');

           $formulario    = request()->formulario;

           $data = (new Distrito)->newQuery()->with('getCity');
           $data = $data->get();

           return response()->json([
             'data' => $data,
           ]);
        }

        /** @desc: Esta funcion se encarga de actualizar estatus **/
        public function updateStatus()
        {
          $id        = request()->id;
          $statusUpd = Distrito::find($id);
          $statusUpd ->status  = ($statusUpd ->status == 1)?  0 : 1;
          $statusUpd ->update();
          return response()->json([
            'object' => 'success',
          ]);
        }


}
