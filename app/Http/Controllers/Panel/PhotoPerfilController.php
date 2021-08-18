<?php

namespace App\Http\Controllers\Panel;

use App\Http\Requests\CreatePhotoPerfilRequest;
use App\Http\Requests\UpdatePhotoPerfilRequest;
use App\Repositories\PhotoPerfilRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\RolUsers;
use App\Models\RolMenu;
use App\Models\User;
use App\Models\PhotoPerfil;
use App\Classes\MenuClass;
use App\Models\Menu;
use Flash;
use Response;


/**
  * @desc: Esta clase se encarga de tarer los datos
  * @author Gloribel Delgado gdelgado.winhold@gmail.com
**/

class PhotoPerfilController extends AppBaseController
{
    /** @var  PhotoPerfilRepository */
    private $photoPerfilRepository;


    /** @desc: Constructor de variables globales  **/
    public function __construct(PhotoPerfilRepository $photoPerfilRepo)
    {
        $this->photoPerfilRepository = $photoPerfilRepo->with('getUsersApp');
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
     * Display a listing of the PhotoPerfil.
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

        $valor = $this->validPermisoMenu(23);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $photoPerfils = $this->photoPerfilRepository->all();

        return view('panel.photo_perfils.index')
            ->with('photoPerfils', $photoPerfils)
            ->with('main',         $main);
    }

    /**
     * Show the form for creating a new PhotoPerfil.
     *
     * @return Response
     */

     /** @desc: Esta funcion se encarga de crear los datos a guardar **/
     public function create()
    {
        $main = new MenuClass();
        $main = $main->getMenu();

        $tpUsersAps    = User::select(DB::raw("UPPER(CONCAT(apellidos,'  ', nombres)) AS name"), "users_apps.id as id")
        ->orderBy('name',  'ASC')
        ->pluck( '(apellidos||" " ||nombres)as name', 'users_apps.id as id');

        return view('panel.photo_perfils.create')
        ->with('tpUsersAps', $tpUsersAps)
        ->with('main',       $main);
    }

    /**
     * Store a newly created PhotoPerfil in storage.
     *
     * @param CreatePhotoPerfilRequest $request
     *
     * @return Response
     */

     /** @desc: Esta funcion se encarga de guardar los datos **/
     public function store(CreatePhotoPerfilRequest $request)
    {
        $input = $request->all();

        $photoPerfil = $this->photoPerfilRepository->create($input);

        Flash::success('Foto Perfil guardada con éxito.');

        return redirect(route('foto-perfil.index'));
    }

    /**
     * Display the specified PhotoPerfil.
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

        $valor = $this->validPermisoMenu(23);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $photoPerfil = $this->photoPerfilRepository->find($id);

        if (empty($photoPerfil)) {
            Flash::error('Foto Perfil no encontrada');

            return redirect(route('foto-perfil.index'));
        }

        return view('panel.photo_perfils.show')
        ->with('photoPerfil', $photoPerfil)
        ->with('main',        $main);
    }

    /**
     * Show the form for editing the specified PhotoPerfil.
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

        $valor = $this->validPermisoMenu(23);
        /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
        if ($valor == false){
          return view('errors.403', compact('main'));
        }

        $photoPerfil = $this->photoPerfilRepository->find($id);

        $tpUsersAps  = User::select(DB::raw("UPPER(CONCAT(apellidos,'  ', nombres)) AS name"), "users_apps.id as id")
         ->orderBy('name',  'ASC')
         ->pluck( '(apellidos||" " ||nombres)as name', 'users_apps.id as id');

        if (empty($photoPerfil)) {
            Flash::error('Foto Perfil no encontrada');

            return redirect(route('foto-perfil.index'));
        }

        return view('panel.photo_perfils.edit')
        ->with('photoPerfil', $photoPerfil)
        ->with('tpUsersAps',  $tpUsersAps)
        ->with('main',        $main);
    }

    /**
     * Update the specified PhotoPerfil in storage.
     *
     * @param int $id
     * @param UpdatePhotoPerfilRequest $request
     *
     * @return Response
     */

    /** @desc: Esta funcion se encarga de actualizar los datos guardados **/
    public function update($id, UpdatePhotoPerfilRequest $request)
    {
        $photoPerfil = $this->photoPerfilRepository->find($id);

        if (empty($photoPerfil)) {
            Flash::error('Foto Perfil no encontrada');

            return redirect(route('foto-perfil.index'));
        }

        $photoPerfil = $this->photoPerfilRepository->update($request->all(), $id);

        Flash::success('Foto Perfil actualizada con éxito.');

        return redirect(route('foto-perfil.index'));
    }

    /**
     * Remove the specified PhotoPerfil from storage.
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
        $photoPerfil = $this->photoPerfilRepository->find($id);

        if (empty($photoPerfil)) {
            Flash::error('Foto Perfil no encontrado');

            return redirect(route('foto-perfil.index'));
        }

        $this->photoPerfilRepository->delete($id);

        Flash::success('Foto Perfil eliminada con éxito.');

        return redirect(route('foto-perfil.index'));
    }

    /** @funcion: Se encarga de obtener los datos.**/
    public function getPhotoPerfil(Request $request)
    {
       ini_set('memory_limit','-1');

       $formulario    = request()->formulario;

       $data = (new PhotoPerfil)->newQuery()->with('getUsersApp','getPhotoPerfil');
       $data = $data->get();

       return response()->json([
         'data' => $data,
       ]);
    }

    /** @desc: Esta funcion se encarga de actualizar estatus **/
    public function updateStatus()
        {
          $id    = request()->id;
          $statusUpd = PhotoPerfil::find($id);
          $statusUpd ->status  = ($statusUpd ->status == 1)?  0 : 1;
          $statusUpd ->update();
          return response()->json([
            'object' => 'success',
          ]);
        }
}
