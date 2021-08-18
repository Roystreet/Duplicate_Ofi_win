<?php

namespace App\Http\Controllers\App\Auth;

use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\UsersPasswords;
use App\Models\RolUsers;
use App\Models\Session;
use App\Models\Menu;
use App\Classes\MenuClass;
use App\User;

use Auth;
use Flash;
use Response;
use Socialite;

class LoginController extends AppBaseController
{
    public function __construct()
    {
        $this->middleware('guest', ['only' => 'app']);
    }

    public function login(){
      $credentials = $this->validate(request(), [
        'email'    => 'required|string',
        'password' => 'required|string',
      ],
      [
        'email.required'     => 'Este campo es obligatorio',
        'password.required'  => 'Este campo es obligatorio',
      ]);
      if(Auth::attempt($credentials)){
        if (auth()->user()->isexterno == true){
          Auth::logout();
          Flash::error('Acceso restringido.');
          return back()
          ->withErrors(['email' => 'Acceso restringido.'])
          ->withInput(request(['email']));
        }

          return redirect()->route('home');
      }
      Flash::error('Error usuario o contraseña no válidos.');

        return back()
        ->withErrors(['password' => 'Error usuario o contraseña no válidos.'])
        ->withInput(request(['email']));

    }


    // public function login(){
    //   $credentials    = $this->validate(request(), [
    //     'email'       => 'required|string|email',
    //     'password'    => 'required|string',
    //   ],
    //   [
    //     'email.required'     => 'El campo email es obligatorio',
    //     'password.required'  => 'El campo contraseña es obligatorio',
    //   ]);
    //
    //   if(Auth::attempt($credentials)){
    //
    //     $user = User::find(auth()->user()->id);
    //     if ($user->isexterno == true){
    //
    //       //BLOQUEADO
    //       if($user->id_status_users_app == 3){
    //         Auth ::logout();
    //         Flash::error('Disculpe, su usuario se encuentra bloqueado, por favor contactar a soporte.');
    //         return back()
    //         ->withErrors(['general' => 'Disculpe, su usuario se encuentra bloqueado, por favor contactar a soporte'])
    //         ->withInput(request(['email']));
    //       }
    //
    //       //PRE-REGISTRO
    //       if($user->id_status_users_app == 3){
    //         $date1 = new \DateTime($statusUser->updated_at);
    //         $date2 = new \DateTime("now");
    //         $diff  = $date1->diff($date2);
    //
    //         //BLOQUEADO NO CARGO DATOS
    //         if($diff->days > 30){
    //           $user->id_status_users_app = 3;
    //           $user->update();
    //           Auth ::logout();
    //           Flash::error('Disculpe, su usuario se encuentra bloqueado, por favor contactar a soporte.');
    //           return back()
    //           ->withErrors(['general' => 'Disculpe, su usuario se encuentra bloqueado, por favor contactar a soporte'])
    //           ->withInput(request(['email']));
    //         }
    //       }
    //
    //     }
    //
    //     else {
    //       Auth ::logout();
    //       Flash::error('Su registro no se encuentra disponible en esta sección');
    //       return back()
    //       ->withErrors(['general' => 'Su registro no se encuentra disponible en esta sección'])
    //       ->withInput(request(['email']));
    //     }
    //     return redirect()->route('panel');
    //   }
    //
    //
    //   $datosSession = [
    //     'token'     => request()->email,
    //     'd_inicio'  => date('Y-m-d'),
    //     'h_inicio'  => date('H:i:s'),
    //     'navegador' => $this->getBrowser(),//request()->header('User-Agent'),
    //     'ip'        => $this->getRealIP(),
    //     'id_status_session' => 3
    //   ];
    //
    //   Session::create($datosSession);
    //   $date = new \DateTime();
    //   $date->modify('-1 hours');
    //
    //   //SE INTENTO LOGUEAR 10 VECES CLAVE ERRADA
    //   $countSessionToday = Session::where('token',request()->email)->where('id_status_session',3)->where('created_at', '>', $date)->count();
    //   if($countSessionToday >= 10){
    //     $statusUser = User::where('email',request()->email)->first();
    //     if ($statusUser){
    //       $statusUser->id_status_users_app = 3;
    //       $statusUser->update();
    //       Auth ::logout();
    //       Flash::error('Disculpe, su usuario se encuentra bloqueado, por favor contactar a soporte.');
    //       return back()
    //       ->withErrors(['general' => 'Disculpe, su usuario se encuentra bloqueado, por favor contactar a soporte'])
    //       ->withInput(request(['email']));
    //     }
    //
    //   }
    //
    //     return back()
    //     ->withErrors(['general' => 'Error usuario o contraseña '])
    //     ->withInput(request(['email']));
    //
    // }
    //
    // public function home()
    // {
    //   $main = new MenuClass();
    //   $main = $main->getMenu();
    //   $user = User::find(auth()->user()->id);
    //
    //   if ($user->isexterno == true){
    //
    //     $datosSession = [
    //       'token'     => auth()->user()->email,
    //       'd_inicio'  => date('Y-m-d'),
    //       'h_inicio'  => date('H:i:s'),
    //       'navegador' => $this->getBrowser(),//request()->header('User-Agent'),
    //       'ip'        => $this->getRealIP(),
    //       'id_status_session' => 1
    //     ];
    //     Session::create($datosSession);
    //
    //     $rolUser = RolUsers::where('id_user', auth()->user()->id)->first();
    //     return view('App.home_app', compact('main', 'rolUser'));
    //   }
    //   else{
    //     $datosSession = [
    //       'token'     => auth()->user()->email,
    //       'd_inicio'  => date('Y-m-d'),
    //       'h_inicio'  => date('H:i:s'),
    //       'navegador' => $this->getBrowser(),//request()->header('User-Agent'),
    //       'ip'        => $this->getRealIP(),
    //       'id_status_session' => 1
    //     ];
    //     Session::create($datosSession);
    //     return view('home');
    //   }
    // }
    //
    // public function redirectToProvider($provider)
    // {
    //   return Socialite::driver($provider)->redirect();
    // }
    //
    // public function handleProviderCallback($provider)
    // {
    //   // $user  = Socialite::driver($provider)->stateless()->user();
    //     $user = Socialite::driver($provider)->user();
    //
    //     $authUser = $this->findUser($user, $provider);
    //     if($authUser)
    //     {
    //       $datosSession = [
    //       'token'     => $user{'email'},
    //       'd_inicio'  => date('Y-m-d'),
    //       'h_inicio'  => date('H:i:s'),
    //       'navegador' => $this->getBrowser(),//request()->header('User-Agent'),
    //       'ip'        => $this->getRealIP(),
    //       'id_status_session' => 1
    //       ];
    //       Session::create($datosSession);
    //
    //       Auth::login($authUser, true);
    //       return redirect()->to('/home');
    //
    //     }else{
    //       $email    = $this->registerUser($user, $provider);
    //       $authUser = $this->findUser($user, $provider);
    //       if($authUser)
    //       {
    //         $datosSession = [
    //         'token'     => $user{'email'},
    //         'd_inicio'  => date('Y-m-d'),
    //         'h_inicio'  => date('H:i:s'),
    //         'navegador' => $this->getBrowser(),//request()->header('User-Agent'),
    //         'ip'        => $this->getRealIP(),
    //         'id_status_session' => 1
    //         ];
    //         Session::create($datosSession);
    //
    //         Auth::login($authUser, true);
    //         return redirect()->to('/home');
    //
    //       }
    //     }
    //
    //     Auth ::logout();
    //     Flash::error('Disculpe, ud aun no se encuentra registrado.');
    //     return redirect()->to('/app');
    // }
    //
    // public function findUser($user, $provider) {
    //
    //   if($provider == 'google'){
    //      $email    = mb_strtolower($user{'email'});
    //      $authUser = User::where('email', $email)->first();
    //     if ($authUser){
    //       return $authUser;
    //     }
    //   }
    //   return false;
    //
    // }
    //
    // public function registerUser($user, $provider)
    // {
    //
    //     try{
    //       DB::beginTransaction();
    //       $email    = mb_strtolower($user{'email'});
    //       $password = rand(100000,999999);
    //
    //       $dataUserApp            = [
    //         'email'               => $email,
    //         'id_status_users_app' => 1
    //       ];
    //       $id_user_app = User::create($dataUserApp)->id;
    //
    //       $dataUser             = [
    //         'email'             => $email,
    //         'email_verified_at' => $email,
    //         'password'          => Hash::make($password),
    //       ];
    //       User::create($dataUser);
    //
    //       $dataPasswordUserApp = [
    //         'id_users'     => $id_user_app,
    //         'password'         => Hash::make($password),
    //         'password_repeat'  => Hash::make($password),
    //         'status'           => true,
    //       ];
    //       UsersPasswords::create($dataPasswordUserApp)->id;
    //
    //     DB::commit();
    //     }catch(\Exception $e){
    //       DB::rollback();
    //       // dd($e);
    //       Flash::error('Hemos encontrado algunos errores.');
    //       return  redirect()->route('register_app');
    //     }
    //     return $email;
    //
    //   }
    //
    // function getRealIP(){
    //
    //  if (isset($_SERVER["HTTP_CLIENT_IP"])){
    //
    //      return $_SERVER["HTTP_CLIENT_IP"];
    //
    //  }elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
    //
    //      return $_SERVER["HTTP_X_FORWARDED_FOR"];
    //
    //  }elseif (isset($_SERVER["HTTP_X_FORWARDED"])){
    //
    //      return $_SERVER["HTTP_X_FORWARDED"];
    //
    //  }elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])){
    //
    //      return $_SERVER["HTTP_FORWARDED_FOR"];
    //
    //  }elseif (isset($_SERVER["HTTP_FORWARDED"])){
    //
    //      return $_SERVER["HTTP_FORWARDED"];
    //
    //  }else{
    //
    //      return $_SERVER["REMOTE_ADDR"];
    //
    //  }
    // }
    //
    // function getBrowser(){
    //   $user_agent = $_SERVER['HTTP_USER_AGENT'];
    //   if(strpos($user_agent, 'MSIE') !== FALSE)
    //       return 'Internet explorer';
    //   elseif(strpos($user_agent, 'Edge') !== FALSE) //Microsoft Edge
    //       return 'Microsoft Edge';
    //   elseif(strpos($user_agent, 'Trident') !== FALSE) //IE 11
    //       return 'Internet explorer';
    //   elseif(strpos($user_agent, 'Opera Mini') !== FALSE)
    //       return "Opera Mini";
    //   elseif(strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR') !== FALSE)
    //       return "Opera";
    //   elseif(strpos($user_agent, 'Firefox') !== FALSE)
    //       return 'Mozilla Firefox';
    //   elseif(strpos($user_agent, 'Chrome') !== FALSE)
    //       return 'Google Chrome';
    //   elseif(strpos($user_agent, 'Safari') !== FALSE)
    //       return "Safari";
    //   else
    //       return 'No hemos podido detectar su navegador';
    //
    // }

}
