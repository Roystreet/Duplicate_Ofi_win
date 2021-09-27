<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateUsersTempOvsRequest;
use App\Http\Requests\UpdateUsersTempOvsRequest;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Models\RolUsers;
use App\Models\RolMenu;
use App\Models\Country;
use App\Classes\MenuClass;
use App\Models\Menu;
use App\UserTempOvs;

use Auth;
use Flash;
use Response;

class UsersOvTempsController extends AppBaseController
{

    public function validPermisoMenu($id_menu)
    {

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

    public function index(Request $request)
    {
      $main = new MenuClass();
      $main = $main->getMenu();

      $valor = $this->validPermisoMenu(49);
      if ($valor == false){
        return view('errors.403', compact('main'));
      }

      $pais          = Country       ::WHERE('status', '=', true)->orderBy('country',          'ASC')->pluck('country',          'id');

        return view('admin.users_temp_ovs.index')
        ->with('pais',          $pais)
        ->with('main',          $main);

    }


    public function updateStatusTempOvs(Request $request) {
      $data = UserTempOvs::find($request->id_users_temp_ovs);
      $data->status_ov = $request->status_ov;
      $data->id_user_modify = Auth::user()->id;
      $data->update();

      $data = UserTempOvs::find($request->id_users_temp_ovs);

      return response()->json([
        'data' => $data,
        'flag' => $data ? true : false
      ]);
    }

    public function getUsersTempOvs(Request $request)
    {
       ini_set('memory_limit','-1');

       $formulario    = request()->formulario;

       $data = (new UserTempOvs)->newQuery()->with(['getCountry',  'getUserModify', 'getTpDocumentIdenties' ] );

       if($formulario{'name'               }) {
         $data = $data->orWhere('first_name', 'like', '%' .mb_strtoupper($formulario{'name'}) . '%');
         $data = $data->orWhere('last_name', 'like', '%' .mb_strtoupper($formulario{'name'} ). '%');
         $data = $data->orWhere('middle_name', 'like', '%' .mb_strtoupper($formulario{'name'}) . '%');
       }
       if($formulario{'email'              }) { $data = $data->where('email', mb_strtolower($formulario{'email'              }));}
       if($formulario{'phone'              }) { $data = $data->where('phone',               $formulario{'phone'           });}
       if($formulario{'id_country'         }) { $data = $data->where('id_country',          $formulario{'id_country'         });}

       $data = $data->orderBy('updated_at', 'asc')->get();

       return response()->json([
         'data' => $data,
       ]);
    }

    public function getUsersTempOvsId($id)
    {
      $data = UserTempOvs::with(['getCountry',  'getUserModify', 'getTpDocumentIdenties' ] )->find($id);
      return response()->json([
        'data' => $data,
        'flag' => $data ? true : false
      ]);
    }

    public function get_format($df) {
       $str = '';
       $str .= ($df->invert == 1) ? ' - ' : '';
       if ($df->y > 0) {
           // years
           $str .= ($df->y > 1) ? $df->y . ' Años ' : $df->y . ' Año ';
       } if ($df->m > 0) {
           // month
           $str .= ($df->m > 1) ? $df->m . ' Meses ' : $df->m . ' Mes ';
       } if ($df->d > 0) {
           // days
           $str .= ($df->d > 1) ? $df->d . ' Días ' : $df->d . ' Dia ';
       } if ($df->h > 0) {
           // hours
           $str .= ($df->h > 1) ? $df->h . ' Horas ' : $df->h . ' Hora ';
       } if ($df->i > 0) {
           // minutes
           $str .= ($df->i > 1) ? $df->i . ' Minutos ' : $df->i . ' Minuto ';
       }

       return $str;
    }


}
