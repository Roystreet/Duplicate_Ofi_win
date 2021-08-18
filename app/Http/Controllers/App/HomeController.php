<?php

namespace App\Http\Controllers\App;

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

class HomeController extends AppBaseController
{
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('guest', ['only' => 'app']);
  }

  public function index()
  {
    $main = new MenuClass();
    $main = $main->getMenu();

    $datosSession = [
    'token'     => auth()->user()->email,
    'd_inicio'  => date('Y-m-d'),
    'h_inicio'  => date('H:i:s'),
    'navegador' => $this->getBrowser(),//request()->header('User-Agent'),
    'ip'        => $this->getRealIP(),
    'id_status_session' => 1
    ];
    Session::create($datosSession);

    $rolUser = RolUsers::where('id_user', auth()->user()->id)->first();
    return view('app.home', compact('main', 'rolUser'));
  }

  function getRealIP(){

   if (isset($_SERVER["HTTP_CLIENT_IP"])){

       return $_SERVER["HTTP_CLIENT_IP"];

   }elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){

       return $_SERVER["HTTP_X_FORWARDED_FOR"];

   }elseif (isset($_SERVER["HTTP_X_FORWARDED"])){

       return $_SERVER["HTTP_X_FORWARDED"];

   }elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])){

       return $_SERVER["HTTP_FORWARDED_FOR"];

   }elseif (isset($_SERVER["HTTP_FORWARDED"])){

       return $_SERVER["HTTP_FORWARDED"];

   }else{

       return $_SERVER["REMOTE_ADDR"];

   }
  }

  function getBrowser(){
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    if(strpos($user_agent, 'MSIE') !== FALSE)
        return 'Internet explorer';
    elseif(strpos($user_agent, 'Edge') !== FALSE) //Microsoft Edge
        return 'Microsoft Edge';
    elseif(strpos($user_agent, 'Trident') !== FALSE) //IE 11
        return 'Internet explorer';
    elseif(strpos($user_agent, 'Opera Mini') !== FALSE)
        return "Opera Mini";
    elseif(strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR') !== FALSE)
        return "Opera";
    elseif(strpos($user_agent, 'Firefox') !== FALSE)
        return 'Mozilla Firefox';
    elseif(strpos($user_agent, 'Chrome') !== FALSE)
        return 'Google Chrome';
    elseif(strpos($user_agent, 'Safari') !== FALSE)
        return "Safari";
    else
        return 'No hemos podido detectar su navegador';

  }

}
