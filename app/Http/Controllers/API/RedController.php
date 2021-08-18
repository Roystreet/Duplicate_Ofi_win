<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Validator, Redirect, Response, File;

use App\Models\Views\vw_user_app_data;

use App\Models\UsersPasswords;
use App\Models\User;
use App\Models\RolUsers;
use App\Models\UsersRed;
use App\Models\Country;
use App\Models\Departament;
use App\Models\City;
use App\Models\Distrito;
use App\Models\TokenUsersApp;

use App\User;
use Auth;
use Mail;


class RedController extends AppBaseController
{

    public function guid_widgetTeam         (Request $request)
    {
        $input = (object) $request->all();

        $userData = null;

        if(property_exists ($input, 'userid')   ){
            $userData = vw_user_app_data::where('userid',   $input->userid)->first();
        }
        if(!$userData){
            return Response::json(array(
                'status' => 490,
                'data'   => [
                    'post'=> [
                        'Error' => 'does not exist',
                    ]
                ]
            ), 490 );
        }

        return Response::json(array(
            'status' => 200,
            'data'   => [
                'posts'=> [
                    'guid' => "U2FsdGVkX18JRV3g7a7ZXSplSc12B4kdYb-OQ1UALTY",
                ]
            ]
        ), 200);

    }
    //Comentario
    public function structure_getLevelCount (Request $request)
    {
        $input = (object) $request->all();

        $userData = null;

        if(property_exists ($input, 'userid')   ){
            $userData = vw_user_app_data::where('userid',   $input->userid)->first();
        }
        if(!$userData){
            return Response::json(array(
                'status' => 490,
                'data'   => [
                    'post'=> [
                        'Error' => 'does not exist',
                    ]
                ]
            ), 490 );
        }

        $arrayLevels = explode(',',$input->levels );

        foreach ($arrayLevels as $key => $value) {
            $redUserMe   = UsersRed::where('id_users_sponsor',  $userData->userid)->count();
        }

        dd($redUserMe);


    }
    public function tripComplete            (Request $request)
    {
        // code...
    }


}
