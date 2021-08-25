<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['middleware' => 'secret'], function () {

  Route::POST('xflow/user_create',        'API\UserController@user_create');
  Route::POST('xflow/user_usernameCheck', 'API\UserController@user_usernameCheck');
  Route::POST('xflow/user_get',           'API\UserController@user_get');
  Route::POST('xflow/user_sponsorCheck',  'API\UserController@user_sponsorCheck');
  Route::POST('xflow/user_emailCheck',    'API\UserController@user_emailCheck');
  Route::POST('xflow/user_phoneCheck',    'API\UserController@user_phoneCheck');
  Route::POST('xflow/user_update',        'API\UserController@user_update');
  Route::POST('xflow/user_passwordReset', 'API\UserController@user_passwordReset');
  Route::POST('xflow/user_balanceCheck',  'API\UserController@user_balanceCheck');
  Route::POST('xflow/user_balanceUpdate', 'API\UserController@user_balanceUpdate');

  Route::POST('xflow/guid_widgetTeam',         'API\RedController@guid_widgetTeam');
  Route::POST('xflow/structure_getLevelCount', 'API\RedController@structure_getLevelCount');
  Route::POST('xflow/tripComplete',            'API\RedController@tripComplete');
  Route::POST('xflow/user_authenticate',       'API\UserController@user_authenticate');

});
