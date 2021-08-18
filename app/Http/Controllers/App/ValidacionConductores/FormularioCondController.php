<?php

namespace App\Http\Controllers\App\ValidacionConductores;

use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\RolMenu;
use App\Models\Session;
use App\Models\User;
use App\Models\RolUsers;
use App\Models\UsersRed;
use App\Models\UsersPasswords;
use App\Models\StatusUsersApp;
use App\User;
use Auth;
use Flash;
use Response;

use App\Classes\MenuClass;
use App\Models\Menu;



class FormularioCondController extends AppBaseController
{

  public function FormularioCond() {

    $main = new MenuClass();
    $main = $main->getMenu();

    return view('App.formulario_cond.create')
    ->with('main',  $main);


    }


}
