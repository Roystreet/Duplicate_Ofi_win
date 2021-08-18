<?php

namespace App\Http\Controllers\App\Auth;

use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\UsersToken;
use App\Models\UsersRed;
use App\Classes\MenuClass;
use App\Models\Menu;
use App\User;
use Mail;
use Auth;
use Flash;
use Response;
use Socialite;
use Password;

class RecoveryController extends AppBaseController
{
  /*
  * VIEW
  **/
  public function rememberUser()
  {
    return view('app.recovery.user');
  }

  /*
  * VIEW
  **/
  public function recoveryPassword()
  {
    return view('app.recovery.password');
  }

  /*
  * SEND EMAIL USER I
  **/
  public function rememberUserSend()
  {
    $respuesta     = false;
    $dato          = request()->email;
    $queryEmail    = User::where('email', $dato)->first();
    $queryPhone    = User::where('phone', $dato)->first();

    $name;
    $email;
    $user = null;

    if ($queryEmail) {
      $name      = $queryEmail->first_name . ' ' . $queryEmail->last_name;
      $email     = $dato;
      $user      = UsersRed::where('id_users_invitado', $queryEmail->id)->first()->codigo_invitado;
    }
    else if($queryPhone){
      $name      = $queryPhone->first_name . ' ' . $queryPhone->last_name;
      $email     = $queryPhone->email;
      $user      = UsersRed::where('id_users_invitado', $queryPhone->id)->first()->codigo_invitado;
    }

    if($user){
      $respuesta =  $this->sendEmailUser($email,$user,$name);
    }else{
      $respuesta = false;
    }


    if ($respuesta == true) {
      Flash::success('Hemos enviado un correo a su cuenta para restablecer su contraseña.');
      return redirect(route('forget-user'));
    } else {
      Flash::error('No hemos encontrado tú registro.');
      return redirect(route('forget-user'));
    }
  }

  /*
  * SEND EMAIL USER II
  **/
  public function sendEmailUser($dato, $user, $name)
  {
    $token      = str_random(10);

    $datosToken = [
      'id_tp_token' => 5,
      'token_llave' => $dato,
      'token_code'  => $token,
      'status'      => true
    ];

    $queryToken = UsersToken::where('token_llave', $dato)->where('id_tp_token', 5)->update(array('id_tp_token' => 4));
    UsersToken::create($datosToken);

    $a = array("token" => $token, "email" => $dato, "user" => $user, "name" => $name);
    $s = $dato;

    Mail::send('emails.remember_user', $a, function ($message) use ($s) {
      $message->from('no-reply@winhold.net', 'WIN RIDESHARE');
      $message->to($s)->subject('Recupera tu usuario | WIN RIDESHARE');
    });
    return true;
  }



  /*
  * SEND EMAIL PASSW I
  **/
  public function rememberPasswSend()
  {
    $credentials    = $this->validate(
      request(),
      [
        'email'       => 'required|string',
      ],
      [
        'email.required'     => 'El campo es obligatorio',
      ]
    );


    $respuesta     = false;
    $dato          = request()->email;
    $queryEmail    = User::where('email', $dato)->first();
    $queryPhone    = User::where('phone', $dato)->first();

    $name;
    $email;
    $user = null;

    if ($queryEmail) {
      $name      = $queryEmail->first_name . ' ' . $queryEmail->last_name;
      $email     = $dato;
      $user      = UsersRed::where('id_users_invitado', $queryEmail->id)->first()->codigo_invitado;
    }
    else if($queryPhone){
      $name      = $queryPhone->first_name . ' ' . $queryPhone->last_name;
      $email     = $queryPhone->email;
      $user      = UsersRed::where('id_users_invitado', $queryPhone->id)->first()->codigo_invitado;
    }

    if($user){
      $respuesta =  $this->sendEmail($email,$user,$name);
    }else{
      $respuesta = false;
    }


    //FINALMENTE
    if ($respuesta == true) {
      Flash::success('Hemos enviado un correo a su cuenta para restablecer su contraseña.');
      return redirect(route('forget-pass'));
    } else {
      Flash::error('No hemos encontrado tú registro.');
      return redirect(route('forget-pass'));
    }
  }

  /*
  * SEND EMAIL PASSW II
  **/
  public function sendEmail($dato, $name)
  {
    $token      = str_random(10);

    $datosToken = [
      'id_tp_token' => 2,
      'token_llave' => $dato,
      'token_code'  => $token,
      'status'      => true
    ];

    $queryToken = UsersToken::where('token_llave', $dato)->where('id_tp_token', 2)->update(array('id_tp_token' => 4));
    UsersToken::create($datosToken);


    $a = array("token" => $token, "email" => $dato,"name" => $name);
    $s = $dato;

    Mail::send('emails.recovery_password', $a, function ($message) use ($s) {
      $message->from('no-reply@winhold.net', 'WIN RIDESHARE');
      $message->to($s)->subject('Restablecer Contraseña | WIN RIDESHARE');
    });

    return true;
  }



  public function reset($token, $email)
  {
    $queryToken = UsersToken::where('token_llave', $email)->where('id_tp_token', 2)->where('token_code', $token)->first();
    if ($queryToken) {
      Flash::success('Introduzca su nueva contraseña.');
      return redirect(route('password_new', ['email' => $email, 'token' => $token]));
    } else {
      $queryTokenUse = UsersToken::where('token_llave', $email)->where('id_tp_token', '!=', 2)->where('token_code', $token)->first();
      if ($queryTokenUse) {
        Flash::error('Lo sentimos, Ya se restablecio su contraseña a traves de este link, envie un nuevo la solicitud de lo contrario.');
        return redirect(route('forget-pass'));
      }
      Flash::error('Lo sentimos, hemos encontrado que su correo de enlace fue alterado.');
      return redirect(route('forget-pass'));
    }
  }

  public function passwordnew($email, $token)
  {
    $queryToken = UsersToken::where('token_llave', $email)->where('id_tp_token', 2)->where('token_code', $token)->first();
    if ($queryToken) {
      return view('App.recovery_password.passwordnew', compact('email', 'token'));
    } else {
      Flash::error('Lo sentimos, hemos encontrado que su correo de enlace fue alterado.');
      return redirect(route('forget-pass'));
    }
  }

  public function store()
  {
    $input = request()->all();

    $queryToken = UsersToken::where('token_llave', $input{
    'email'})->where('id_tp_token', 2)->where('token_code', $input{
    'token'})->first();
    if (!$queryToken) {
      Flash::error('Lo sentimos, hemos encontrado que su correo de enlace fue alterado.');
      return redirect(route('forget-pass'));
    }

    try {
      DB::beginTransaction();

      $dataUser             = [
        'password'          => Hash::make($input{
        'password'}),
      ];
      $userSearch = User::where('email', $input{
      'email'})->first();
      if ($userSearch) {
        $userSearch->update($dataUser);
      }
      $dataToken       = [
        'id_tp_token'  => 3,
      ];
      $queryToken = UsersToken::where('token_llave', $input{
      'email'})->where('id_tp_token', 2)->where('token_code', $input{
      'token'})->first();
      if ($queryToken) {
        $queryToken->update($dataToken);
      }


      DB::commit();
    } catch (\Exception $e) {
      DB::rollback();
      dd($e);
      Flash::error('Hemos encontrado algunos errores.');
      return  redirect()->route('password_new');
    }
    Flash::success('Restablecimos su contraseña de forma exitosa, por favor ingrese.');
    return  redirect()->route('login');
  }
}
