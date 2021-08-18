<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Classes\MenuClass;
use App\Models\Views\vw_user_app_data;
use App\User;
use App\Mail\RestaurarContrasenia;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use App\Notifications\ResetPasswordNotification;
use App\Exports\UsersExport;
use App\Exports\RedUserExport;
use App\Exports\pagosExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Classes\Red;

class ReportController extends Controller
{
    function viewReportes(){

        $main = new MenuClass();
        $main = $main->getMenu();
        return view('panel.report.administracion',compact('main'));
    }

    function getUsuaurio(){
        $campo = "";
        $u = [];
        foreach(request()->all() as $key => $value){
            if($value!= ""){
                $columna = $key;
                $campo =  $value;
                break;
            }
        }
        if($campo == ""){
            return response()->json(["object"=>"error",
            "data"=>$u,
                                        "message"=>"No hay datos ingresados"
            ]);
        }
        $u = vw_user_app_data::where($columna,  $campo )->first();
        if($u){
            return response()->json(["object"=>"success","data"=>$u]);
        }else{
            return response()->json(["object"=>"error","message"=>"no se encontró datos."]);
        }

    }

    function viwDetalle(){
        $id = request()->id;
        $main = new MenuClass();
        $main = $main->getMenu();
        return view('panel.report.detalle_usuario',compact('main','id'));
    }

    function obtener(){
        $u = vw_user_app_data::where('userid', request()->id)->first();
        return response()->json(["object"=>"success","data"=>$u]);
    }

    function restaurarContrasena(){
    $up = vw_user_app_data::where('userid', request()->id)->first();
    $u = User::where('email',$up->email)->first();
    $u->password = bcrypt(request()->password);
    $u->save();
    return response()->json(["object"=>"success","message"=>"Contraseña  cambiada"]);
    }

    function enviarCorreo(){
        try {
            $up = vw_user_app_data::where('userid', request()->id)->first();
            $status = Password::sendResetLink(
                ["email"=>$up->email]
            );
            return response()->json(["data"=>$up, "object"=>"success"]);
        } catch (\Exception $e) {
            report($e);
            return response()->json(["message"=>'hay problemas para enviar correos.', "object"=>"error"]);
        }

    }

    function reportusuario(){
      return Excel::download(new UsersExport, 'users.xlsx');
    }
    function reportRedusuario(){
        $usuario = request()->username;
          return Excel::download(new RedUserExport($usuario), 'red-'.$usuario.'.xlsx');
    }

    function pagar(){
        $usuario = 'wilder015';
        return Excel::download(new pagosExport($usuario), 'red-.xlsx');
    }
}
