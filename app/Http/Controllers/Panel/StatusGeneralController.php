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

class StatusGeneralController extends AppBaseController
{

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

  /** @funcion: Vista del listado de consultas realizadas.**/
  public function index()
  {
    $main = new MenuClass();
    $main = $main->getMenu();

    $valor = $this->validPermisoMenu(34);
    /** Valida si tiene acceso al menu, de lo contrario envia una pantalla de error .**/
    if ($valor == false){
      return view('errors.403', compact('main'));
    }

    return view('panel.status.index')
        ->with('main',       $main);
  }

}
