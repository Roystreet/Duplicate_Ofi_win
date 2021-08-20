<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Repositories\CountryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\RolUsers;
use App\Models\RolMenu;
use App\Models\Country;
use App\Classes\MenuClass;
use App\Models\Menu;
use Flash;
use Response;


/**
  * @desc: Esta clase se encarga de tarer los datos
  * @author Gloribel Delgado gdelgado.winhold@gmail.com
**/

class CountryController extends AppBaseController
{
    /** @var  CountryRepository */
    private $countryRepository;

  /** @desc: Constructor de variables globales  **/
    public function __construct(CountryRepository $countryRepo)
    {
        $this->countryRepository = $countryRepo;
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
     * Display a listing of the Country.
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

        $valor = $this->validPermisoMenu(9);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $countries = $this->countryRepository->all();

        return view('admin.countries.index')
            ->with('countries', $countries)
            ->with('main',      $main);
    }

    /**
     * Show the form for creating a new Country.
     *
     * @return Response
     */

    /** @desc: Esta funcion se encarga de crear los datos a guardar **/
    public function create()
    {
      $main = new MenuClass();
      $main = $main->getMenu();

        return view('admin.countries.create')
        ->with('main',   $main);
    }

    /**
     * Store a newly created Country in storage.
     *
     * @param CreateCountryRequest $request
     *
     * @return Response
     */

    /** @desc: Esta funcion se encarga de guardar los datos **/
    public function store(CreateCountryRequest $request)
    {
      $input = $request->all();
      $input{'country'} = mb_strtoupper($input{'country'});

      $country = $this->countryRepository->create($input);

        Flash::success('Pa&iacute;s guardado con &eacute;xito.');

        return redirect(route('pais.index'));
    }

    /**
     * Display the specified Country.
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

        $valor = $this->validPermisoMenu(9);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $country = $this->countryRepository->find($id);

        if (empty($country)) {
            Flash::error('Pa&iacute;s no encontrado');

            return redirect(route('pais.index'));
        }

        return view('admin.countries.show')
        ->with('country', $country)
        ->with('main',    $main);
    }

    /**
     * Show the form for editing the specified Country.
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

        $valor = $this->validPermisoMenu(9);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $country = $this->countryRepository->find($id);

        if (empty($country)) {
            Flash::error('Pa&iacute;s no encontrado');

            return redirect(route('pais.index'));
        }

        return view('admin.countries.edit')
        ->with('country', $country)
        ->with('main',    $main);
    }

    /**
     * Update the specified Country in storage.
     *
     * @param int $id
     * @param UpdateCountryRequest $request
     *
     * @return Response
     */

    /** @desc: Esta funcion se encarga de actualizar los datos guardados **/
    public function update($id, UpdateCountryRequest $request)
    {
        $country = $this->countryRepository->find($id);

        if (empty($country)) {
            Flash::error('Pa&iacute;s no encontrado');

            return redirect(route('pais.index'));
        }
        $input = $request->all();
        $input{'country'} = mb_strtoupper($input{'country'});

        $country = $this->countryRepository->update($input, $id);

        Flash::success('Pa&iacute;s actualizado con &eacute;xito.');

        return redirect(route('pais.index'));
    }

    /**
     * Remove the specified Country from storage.
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
        $country = $this->countryRepository->find($id);

        if (empty($country)) {
            Flash::error('Pa&iacute;s no encontrado');

            return redirect(route('pais.index'));
        }

        $this->countryRepository->delete($id);

        Flash::success('Pa&iacute;s eliminado con &eacute;xito.');

        return redirect(route('pais.index'));
    }

    /** @funcion: Se encarga de obtener los datos.**/
    public function getCountry(Request $request)
    {
       ini_set('memory_limit','-1');

       $formulario = request()->formulario;

       $data = (new Country)->newQuery();
       $data = $data->get();

       return response()->json([
         'data' => $data,
       ]);
    }

    /** @desc: Esta funcion se encarga de actualizar estatus **/
    public function updateStatus()
    {
      $id        = request()->id;
      $statusUpd = Country::find($id);
      $statusUpd ->status  = ($statusUpd ->status == 1)?  0 : 1;
      $statusUpd ->update();
      return response()->json([
        'object' => 'success',
      ]);
    }
}
