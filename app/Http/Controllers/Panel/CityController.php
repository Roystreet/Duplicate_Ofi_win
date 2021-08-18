<?php

namespace App\Http\Controllers\Panel;

use App\Http\Requests\CreateCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Repositories\CityRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\RolUsers;
use App\Models\RolMenu;
use App\Models\Departament;
use App\Models\City;
use App\Classes\MenuClass;
use App\Models\Menu;
use Flash;
use Response;


/**
  * @desc: Esta clase se encarga de tarer los datos
  * @author Gloribel Delgado gdelgado.winhold@gmail.com
**/

class CityController extends AppBaseController
{
    /** @var  CityRepository */
    private $cityRepository;


    /** @desc: Constructor de variables globales  **/
    public function __construct(CityRepository $cityRepo)
    {
        $this->cityRepository = $cityRepo->with('getDepartament');
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
     * Display a listing of the City.
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

        $valor = $this->validPermisoMenu(11);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $cities = $this->cityRepository->all();

        return view('panel.cities.index')
            ->with('cities', $cities)
            ->with('main',   $main);
    }

    /**
     * Show the form for creating a new City.
     *
     * @return Response
     */


    /** @desc: Esta funcion se encarga de crear los datos a guardar **/
    public function create()
    {
        $main = new MenuClass();
        $main = $main->getMenu();

        $departament = Departament::WHERE('status', '=', 'TRUE')->orderBy('departament', 'ASC')->pluck('departament', 'id');

        return view('panel.cities.create')
        ->with('departament', $departament)
        ->with('main',        $main);

    }

    /**
     * Store a newly created City in storage.
     *
     * @param CreateCityRequest $request
     *
     * @return Response
     */

    /** @desc: Esta funcion se encarga de guardar los datos **/
    public function store(CreateCityRequest $request)
    {
        $input = $request->all();
        $input{'city'} = mb_strtoupper($input{'city'});

        $city = $this->cityRepository->create($input);

        Flash::success('Ciudad guardada con éxito.');

        return redirect(route('ciudad.index'));
    }

    /**
     * Display the specified City.
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

        $valor = $this->validPermisoMenu(11);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $city = $this->cityRepository->find($id);

        if (empty($city)) {
            Flash::error('Ciudad no encontrada');

            return redirect(route('ciudad.index'));
        }

        return view('panel.cities.show')
        ->with('city', $city)
        ->with('main', $main);
    }

    /**
     * Show the form for editing the specified City.
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

        $valor = $this->validPermisoMenu(11);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $departament = Departament::WHERE('status', '=', 'TRUE')->orderBy('departament', 'ASC')->pluck('departament', 'id');
        $city        = $this->cityRepository->find($id);

        if (empty($city)) {
            Flash::error('Ciudad no encontrada');

            return redirect(route('ciudad.index'));
        }

        return view('panel.cities.edit')
        ->with('city',        $city)
        ->with('departament', $departament)
        ->with('main',        $main);
    }

    /**
     * Update the specified City in storage.
     *
     * @param int $id
     * @param UpdateCityRequest $request
     *
     * @return Response
     */

    /** @desc: Esta funcion se encarga de actualizar los datos guardados **/
    public function update($id, UpdateCityRequest $request)
    {
        $city = $this->cityRepository->find($id);

        if (empty($city)) {
            Flash::error('Ciudad no encontrada');

            return redirect(route('ciudad.index'));
        }
        $input = $request->all();
        $input{'city'} = mb_strtoupper($input{'city'});

        $city = $this->cityRepository->update($input, $id);

        Flash::success('Ciudad actualizada con éxito.');

        return redirect(route('ciudad.index'));
    }

    /**
     * Remove the specified City from storage.
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
        $city = $this->cityRepository->find($id);

        if (empty($city)) {
            Flash::error('Ciudad no encontrada');

            return redirect(route('ciudad.index'));
        }

        $this->cityRepository->delete($id);

        Flash::success('Ciudad eliminada con éxito.');

        return redirect(route('ciudad.index'));
    }

    /** @desc: Esta funcion se encarga de buscar datos **/
    public function get($id)
    {
        if (!$id) {
            $html  = '<option value="">'.trans('Seleccione una ciudad...').'</option>';
        } else {
            $html  = '<option selected="selected" value="">Seleccione una ciudad...</option>';
            $datos = City::where('status', '=', 'TRUE')->where('id_departament', $id)->get();
            foreach ($datos as $dato) {
            $html .= '<option value="'.$dato->id.'">'.$dato->city.'</option>';
            }
        }

        return response()->json(['html' => $html]);
    }

    /** @funcion: Se encarga de obtener los datos.**/
    public function getCity(Request $request)
        {
           ini_set('memory_limit','-1');

           $formulario    = request()->formulario;

           $data = (new City)->newQuery()->with('getDepartament');
           $data = $data->get();

           return response()->json([
             'data' => $data,
           ]);
        }

    /** @desc: Esta funcion se encarga de actualizar estatus **/
    public function updateStatus()
        {
          $id        = request()->id;
          $statusUpd = City::find($id);
          $statusUpd ->status  = ($statusUpd ->status == 1)?  0 : 1;
          $statusUpd ->update();
          return response()->json([
            'object' => 'success',
          ]);
        }

}
