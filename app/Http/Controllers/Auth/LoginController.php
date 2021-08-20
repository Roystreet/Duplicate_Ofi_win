<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Session;
use App\User;

use Auth;
use Flash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index() {
      return view('auth.login');
    }
    public function login()
    {
        $credentials    = $this->validate(
            request(),
            [
                'email'       => 'required|string|email',
                'password'    => 'required|string',
            ],
            [
                'email.required'     => 'Este campo es obligatorio',
                'password.required'  => 'Este campo es obligatorio',
            ]
        );

        if (Auth::attempt($credentials)) {

            $user = User::find(auth()->user()->id);
            if ($user->isexterno != true) {

                //BLOQUEADO
                if ($user->id_status_users_app == 3) {
                    Auth::logout();
                    Flash::error('Disculpe, su usuario se encuentra bloqueado, por favor contactar a soporte.');
                    return back()
                        ->withErrors(['general' => 'Disculpe, su usuario se encuentra bloqueado, por favor contactar a soporte'])
                        ->withInput(request(['email']));
                }

                //PRE-REGISTRO
                if ($user->id_status_users_app == 3) {
                    $date1 = new \DateTime($statusUser->updated_at);
                    $date2 = new \DateTime("now");
                    $diff  = $date1->diff($date2);

                    //BLOQUEADO NO CARGO DATOS
                    if ($diff->days > 30) {
                        $user->id_status_users_app = 3;
                        $user->update();
                        Auth::logout();
                        Flash::error('Disculpe, su usuario se encuentra bloqueado, por favor contactar a soporte.');
                        return back()
                            ->withErrors(['general' => 'Disculpe, su usuario se encuentra bloqueado, por favor contactar a soporte'])
                            ->withInput(request(['email']));
                    }
                }
            } else {
                Auth::logout();
                Flash::error('Su registro no se encuentra disponible en esta sección');
                return back()
                    ->withErrors(['general' => 'Su registro no se encuentra disponible en esta sección'])
                    ->withInput(request(['email']));
            }
            return redirect()->route('home');
        }


        $datosSession = [
            'token'     => request()->email,
            'd_inicio'  => date('Y-m-d'),
            'h_inicio'  => date('H:i:s'),
            'navegador' => $this->getBrowser(), //request()->header('User-Agent'),
            'ip'        => $this->getRealIP(),
            'id_status_session' => 3
        ];

        Session::create($datosSession);
        $date = new \DateTime();
        $date->modify('-1 hours');

        //SE INTENTO LOGUEAR 10 VECES CLAVE ERRADA
        $countSessionToday = Session::where('token', request()->email)->where('id_status_session', 3)->where('created_at', '>', $date)->count();
        if ($countSessionToday >= 10) {
            $statusUser = User::where('email', request()->email)->first();
            if ($statusUser) {
                $statusUser->id_status_users_app = 3;
                $statusUser->update();
                Auth::logout();
                Flash::error('Disculpe, su usuario se encuentra bloqueado, por favor contactar a soporte.');
                return back()
                    ->withErrors(['general' => 'Disculpe, su usuario se encuentra bloqueado, por favor contactar a soporte'])
                    ->withInput(request(['email']));
            }
        }

        return back()
            ->withErrors(['general' => 'Error usuario o contraseña '])
            ->withInput(request(['email']));
    }


    public function logout()
    {
        $datosSessionAnt = Session::where('token', auth()->user()->email)->orderby('created_at', 'DESC')->first();
        if ($datosSessionAnt) {
            $datosSession = [
                'd_fin' => date('Y-m-d'),
                'h_fin' => date('H:i:s'),
                'id_status_session' => 2
            ];

            $datosSessionAnt->update($datosSession);
        }

        Auth::logout();
        return redirect('/');
    }

    function getRealIP()
    {

        if (isset($_SERVER["HTTP_CLIENT_IP"])) {

            return $_SERVER["HTTP_CLIENT_IP"];
        } elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {

            return $_SERVER["HTTP_X_FORWARDED_FOR"];
        } elseif (isset($_SERVER["HTTP_X_FORWARDED"])) {

            return $_SERVER["HTTP_X_FORWARDED"];
        } elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])) {

            return $_SERVER["HTTP_FORWARDED_FOR"];
        } elseif (isset($_SERVER["HTTP_FORWARDED"])) {

            return $_SERVER["HTTP_FORWARDED"];
        } else {

            return $_SERVER["REMOTE_ADDR"];
        }
    }

    function getBrowser()
    {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        if (strpos($user_agent, 'MSIE') !== FALSE)
            return 'Internet explorer';
        elseif (strpos($user_agent, 'Edge') !== FALSE) //Microsoft Edge
            return 'Microsoft Edge';
        elseif (strpos($user_agent, 'Trident') !== FALSE) //IE 11
            return 'Internet explorer';
        elseif (strpos($user_agent, 'Opera Mini') !== FALSE)
            return "Opera Mini";
        elseif (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR') !== FALSE)
            return "Opera";
        elseif (strpos($user_agent, 'Firefox') !== FALSE)
            return 'Mozilla Firefox';
        elseif (strpos($user_agent, 'Chrome') !== FALSE)
            return 'Google Chrome';
        elseif (strpos($user_agent, 'Safari') !== FALSE)
            return "Safari";
        else
            return 'No hemos podido detectar su navegador';
    }
}
