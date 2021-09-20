<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Classes\MenuClass;
use App\Models\UsersRed;
use App\Models\RolUsers;
use App\Models\Menu;
use App\User;
use Flash;

class ValidacionAjaxController extends Controller
{

    public function phoneValidExists()
    {
      $id_users  = request()->id_users;
      $phone     = request()->phone;

      $querytelefono = User::WHERE ('phone', $phone)->WHERE('id','!=', $id_users)->first();

      if($querytelefono){
            return response()->json([
              "object"  => true,
              "mensaje"  => "Este número de teléfono esta registrado",
            ]);

          }
          else{
            return response()->json([
              "object"  => 'false',
              "mensaje" =>  null
            ]);
          }
    }


    public function usuarioValidExists()
    {
      $id_red_users_app  = request()->id_red_users_app;
      $usuario_invitado  = request()->usuario_invitado;

      $queryusuario    = UsersRed ::WHERE ('usuario_invitado', $usuario_invitado)->WHERE('id','!=', $id_red_users_app)->first();

      if($queryusuario){
            return response()->json([
              "object"  => true,
              "mensaje" => "Este usuario ya esta registrado",
            ]);

          }
          else{
            return response()->json([
              "object"  => 'false',
              "mensaje" =>  null
            ]);
          }
    }

}
