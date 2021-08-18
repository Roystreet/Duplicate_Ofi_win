<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\UsersPasswords;
use App\Models\RolUsers;
use Flash;
use Response;
use Socialite;
use App\User;

class RegisterController extends Controller
{

  public function register() {
    return view('app.auth.register');
  }

  public function store()
  {
      $input = request()->all();

      $validator = Validator::make($input, [
        'email'            => 'email|required|string|unique:users',
        'password'         => 'required|min:6',
        'password_confirm' => 'required|same:password|min:6'
      ],
      [
          'email.required'     => 'Este campo es obligatorio',
          'email.unique'       => 'Ingreso un dato que ya existe.',
          'password.required'  => 'Este campo es obligatorio',
      ]);


      if ($validator->fails()) {
        Flash::error('Hemos encontrado algunos errores.');
        return redirect(route('registro'))
            ->withErrors($validator)
            ->withInput();
      }

      try{
        DB::beginTransaction();

        $dataUser             = [
          'isexterno'            => true,
          'id_status_users_app'  => 1,
          'email'                => mb_strtolower($input{'email'}),
          'password'             => Hash::make($input{'password'}),
        ];
        $id_user = User::create($dataUser)->id;

        $dataPasswordUserApp = [
          'id_users'         => $id_user,
          'password'         => Hash::make($input{'password'}),
          'password_repeat'  => Hash::make($input{'password'}),
          'status'           => true,
        ];
        UsersPasswords::create($dataPasswordUserApp)->id;

      DB::commit();
      }catch(\Exception $e){
        DB::rollback();
        dd($e);
        Flash::error('Hemos encontrado algunos errores.');
        return  redirect()->route('register_app');
      }

      Flash::success('Registrado de forma exitosa, por favor ingrese.');

      return  redirect()->route('login');

    }

}
