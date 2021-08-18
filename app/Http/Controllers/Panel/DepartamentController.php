<?php

namespace App\Http\Controllers\Panel;

use App\Http\Requests\CreateDepartamentRequest;
use App\Http\Requests\UpdateDepartamentRequest;
use App\Repositories\DepartamentRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\TpDocumentIdenties;
use Illuminate\Http\Request;
use App\Models\RolUsers;
use App\Models\RolMenu;
use App\Models\Country;
use App\Models\Departament;
use App\Classes\MenuClass;
use App\Models\Menu;
use Flash;
use Response;


/**
  * @desc: Esta clase se encarga de tarer los datos
  * @author Gloribel Delgado gdelgado.winhold@gmail.com
**/

class DepartamentController extends AppBaseController
{
    /** @var  DepartamentRepository */
    private $departamentRepository;

    /** @desc: Constructor de variables globales  **/
    public function __construct(DepartamentRepository $departamentRepo)
    {
        $this->departamentRepository = $departamentRepo->with('getCountry');
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
     * Display a listing of the Departament.
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

      $valor = $this->validPermisoMenu(10);
      /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
      if ($valor == false){
        return view('errors.403', compact('main'));
      }

      $pais        = Country    ::WHERE('status', '=', 'TRUE')->orderBy('country',     'ASC')->pluck('country',     'id');
      $departament = Departament::WHERE('status', '=', 'TRUE')->orderBy('departament', 'ASC')->pluck('departament', 'id');

      $departaments = $this->departamentRepository->all();


        return view('panel.departaments.index')
            ->with('departaments', $departaments)
            ->with('country',      $pais)
            ->with('departament',  $departament)
            ->with('main',         $main);

    }

    /**
     * Show the form for creating a new Departament.
     *
     * @return Response
     */

     /** @desc: Esta funcion se encarga de crear los datos a guardar **/
     public function create()
    {
        $main = new MenuClass();
        $main = $main->getMenu();

        $pais    = Country::WHERE('status', '=', 'TRUE')->orderBy('country', 'ASC')->pluck('country', 'id');

        return view('panel.departaments.create')
        ->with('country', $pais)
        ->with('main',    $main);
    }

    /**
     * Store a newly created Departament in storage.
     *
     * @param CreateDepartamentRequest $request
     *
     * @return Response
     */

     /** @desc: Esta funcion se encarga de guardar los datos **/
     public function store(CreateDepartamentRequest $request)
    {
        $input = $request->all();
        $input{'departament'} = mb_strtoupper($input{'departament'});

        $departament = $this->departamentRepository->create($input);

        Flash::success('Departamento guardado con éxito.');

        return redirect(route('departamento.index'));
    }

    /**
     * Display the specified Departament.
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

        $valor = $this->validPermisoMenu(10);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $departament = $this->departamentRepository->find($id);

        if (empty($departament)) {
            Flash::error('Departamento no encontrado');

            return redirect(route('departamento.index'));
        }

        return view('panel.departaments.show')
        ->with('departament', $departament)
        ->with('main',        $main);
    }

    /**
     * Show the form for editing the specified Departament.
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

        $valor = $this->validPermisoMenu(10);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $pais        = Country::WHERE('status', '=', 'TRUE')->orderBy('country', 'ASC')->pluck('country', 'id');
        $departament = $this->departamentRepository->find($id);

        if (empty($departament)) {
            Flash::error('Departamento no encontrado');

            return redirect(route('departamento.index'));
        }

        return view('panel.departaments.edit')
        ->with('departament', $departament)
        ->with('country',     $pais)
        ->with('main',        $main);
    }

    /**
     * Update the specified Departament in storage.
     *
     * @param int $id
     * @param UpdateDepartamentRequest $request
     *
     * @return Response
     */

     /** @desc: Esta funcion se encarga de actualizar los datos guardados **/
     public function update($id, UpdateDepartamentRequest $request)
    {
        $departament = $this->departamentRepository->find($id);

        if (empty($departament)) {
            Flash::error('Departamento no encontrado');

            return redirect(route('departamento.index'));
        }
        $input = $request->all();
        $input{'departament'} = mb_strtoupper($input{'departament'});

        $departament = $this->departamentRepository->update($input, $id);

        Flash::success('Departamento actualizado con éxito.');

        return redirect(route('departamento.index'));
    }

    /**
     * Remove the specified Departament from storage.
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
        $departament = $this->departamentRepository->find($id);

        if (empty($departament)) {
            Flash::error('Departamento no encontrado');

            return redirect(route('departamento.index'));
        }

        $this->departamentRepository->delete($id);

        Flash::success('Departamento eliminado con éxito.');

        return redirect(route('departamento.index'));
    }

    /** @desc: Esta funcion se encarga de buscar datos **/
    public function get($id)
    {
        if (!$id) {
            $html  = '<option value="">'.trans('Seleccione un departamento...').'</option>';
            $html2 = '<option value="">'.trans('Seleccione un tipo de documento...').'</option>';
        } else {
            $html  = '<option selected="selected" value="">Seleccione un departamento...</option>';
            $datos = Departament::where('status', '=', 'TRUE')->where('id_country', $id)->get();
            foreach ($datos as $dato) {
                $html .= '<option value="'.$dato->id.'">'.$dato->departament.'</option>';
            }

            $html2 = '<option selected="selected" value="">Seleccione un tipo de documento...</option>';
            $datos2 = TpDocumentIdenties::where('status', '=', 'TRUE')->where('id_country', $id)->get();
            foreach ($datos2 as $dato2) {
                $html2 .= '<option value="'.$dato2->id.'">'.$dato2->description.'</option>';
            }
        }
        return response()->json(['html' => $html, 'html2' => $html2]);
    }

    /** @funcion: Se encarga de obtener los datos.**/
    public function getDepartament(Request $request)
    {
       ini_set('memory_limit','-1');

       $formulario    = request()->formulario;

       $data = (new Departament)->newQuery()->with('getCountry');

       if($formulario{'id_country'    }){ $data = $data->where('id_country',  $formulario{'id_country'    });}
       if($formulario{'id_departament'}){ $data = $data->where('id',          $formulario{'id_departament'});}


       $data = $data->get();

       return response()->json([
         'data' => $data,
       ]);
    }

    /** @desc: Esta funcion se encarga de actualizar estatus **/
    public function updateStatus()
    {
      $id    = request()->id;
      $statusUpd = Departament::find($id);
      $statusUpd ->status  = ($statusUpd ->status == 1)?  0 : 1;
      $statusUpd ->update();
      return response()->json([
        'object' => 'success',
      ]);
    }
}
