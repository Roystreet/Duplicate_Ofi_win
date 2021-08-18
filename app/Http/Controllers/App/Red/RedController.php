<?php

namespace App\Http\Controllers\App\Red;

use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\UsersRed;
use App\Models\RolUsers;
use App\User;
use Auth;
use Flash;
use Response;

use App\Classes\MenuClass;
use App\Models\Menu;



class RedController extends AppBaseController
{

  public function searchSponsor() {
    $dato     = request()->dato;
    $tpcampo  = request()->tpcampo;
    $mensaje  = 'No hemos encontrado su registro';

    if($tpcampo == 'usuario_invitado'){
      $dato = mb_strtolower($dato);
    }

    $user_red = UsersRed::where($tpcampo,$dato)->first();
    if($user_red){

      if($user_red->id_status_red != 1){
        $mensaje  = 'Lo sentimos, su sponsor aún no se encuentra activo.';
      }

      else{
        $user = User::where('id',$user_red->id_users_invitado)->first();
        if($user){
          $user     = User::where('email',$user->email)->first();
          $rol_user = RolUsers::where('id_user',$user->id)->where('id_tp_rol', '!=', 5)->with('getTpRol')->first();

          if($rol_user){

            $user{'rol_user'}  = $rol_user;

            return response()->json([
              'object'    => 'success',
              'mensaje'   => 'Transaccion exitosa',
              'data'      =>  $user
            ]);
          }
          $mensaje = 'Su sponsor aún no culmina el registro de sus datos.';
        }

      }



    }

    return response()->json([
      'object'    => 'error',
      'mensaje'   =>  $mensaje,
      'data'      =>  null
    ]);



  }

  public function saveRol()       {

    $main  = new MenuClass();
    $main  = $main->getMenu();
    $input = request()->all();

    $id       = User::where('email', auth()->user()->email)->first()->id;
    $usersApp = User::find($id);


      try{
        DB::beginTransaction();

        $codigo_rand   = rand(100000,999999);
        $codigo_final;
        do {
          $user_red = UsersRed::where('codigo_invitado',$codigo_rand)->first();
          if(!$user_red){
            $codigo_final = $codigo_rand;
          }
        } while ($codigo_final == null);

        $red_usuario_data = [
          'id_users_sponsor'    => $input{'id_user_sponsor'},
          'id_users_invitado'   => $id,
          'codigo_invitado'     => $codigo_final,
          'id_status_red'       => 2
        ];
        UsersRed::create($red_usuario_data);

        $dataUserRol = [
          'id_user'         => auth()->user()->id,
          'id_tp_rol'       => $input{'tp_rol'},
        ];
        $rolUser = RolUsers::where('id_user', auth()->user()->id)->where('id_tp_rol', $input{'tp_rol'})->first();
        if(!$rolUser){
          $rolUser = RolUsers::create($dataUserRol)->id;
        }

        $dataUserRolBasico = [
          'id_user'         => auth()->user()->id,
          'id_tp_rol'       => 5,
        ];
        $rolUser2 = RolUsers::where('id_user', auth()->user()->id)->where('id_tp_rol', 5)->first();
        if(!$rolUser2){
          $rolUser2 = RolUsers::create($dataUserRolBasico)->id;
        }

      DB::commit();
      }catch(\Exception $e){
        DB::rollback();
        dd($e);
        Flash::error('Tenemos inconvenientes para asignar su cuenta');
        return  redirect()->route('home');
      }
      Flash::success('Registrado de forma exitosa.');
      return  redirect()->route('home');

    }

  public function store()
  {
    $input = request()->all();

    $id       = User::where('email', auth()->user()->email)->first()->id;
    $usersApp = User::find($id);
    $redUser  = UsersRed::where('id_users_invitado', $id)->with('getStatusRed', 'getUsersSponsor')->first();

    try{
      DB::beginTransaction();
        $dataRed = [
          "usuario_invitado"   => $input {'usuario_invitado'},
          "id_status_red"      => ($input{'usuario_invitado'})?  1 : 2,
        ];
        $redUser->update($dataRed);

    DB::commit();
    }catch(\Exception $e){
      dd($e);
      Flash::success('Hemos encontrado algunos errores.');
      DB::rollback();
      return  redirect()->route('profile');
    }

    Flash::success('Actualizado su usuario de forma exitosa.');

    return  redirect()->route('profile');

  }

}
