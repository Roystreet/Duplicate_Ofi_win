<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// DEPURANDO RUTA
Route::get('/', function () {  return view('welcome');})->middleware('checkip');


//Login
// Route::get('/logout',                   '\App\Http\Controllers\Auth\LoginController@logout');
// Route::get('/login',                   'App\Auth\LoginController@login')->name('login')->middleware('checkip');

Route::post('/login',                  'App\Auth\LoginController@index')->name('login-u')->middleware('checkip');
Route::get('/auth/{provider}',         'App\Auth\LoginController@redirectToProvider' )->middleware('checkip');
Route::get('/auth/{provider}/callback','App\Auth\LoginController@handleProviderCallback')->middleware('checkip');
//Registro
Route::get ('/registro',               'Auth\RegisterController@register')->name('registro')->middleware('checkip');
Route::post('/registrando',            'Auth\RegisterController@store')->name('registrando' )->middleware('checkip');
//Revisar gestion
Route::get('/recuperar-usuario',       'App\Auth\RecoveryController@rememberUser')->name('forget-user')->middleware('checkip');
Route::post ('/recuperar-usuario',     'App\Auth\RecoveryController@rememberUserSend' )->name('remenber-user')->middleware('checkip');

Route::get('/recuperar-contraseña',    'App\Auth\RecoveryController@recoveryPassword')->name('forget-pass')->middleware('checkip');
Route::post ('/recuperar-contraseña',  'App\Auth\RecoveryController@rememberPasswSend' )->name('remenber-pass')->middleware('checkip');
Route::get  ('/reset/{token}/{email}', 'App\Auth\RecoveryController@reset')->name('reset-pass')->middleware('checkip');

Auth::routes();


Route::group(['middleware' => 'auth', 'checkip'], function(){

  Route::get('/home',           'App\HomeController@index')->name('home')->middleware('checkip');

  //Primera interaccion registro de rol y sponsor
  Route::post('/saveRol',          'App\Red\RedController@saveRol')->name('saveSponsor')->middleware('checkip');
  Route::post('/searchSponsor',    'App\Red\RedController@searchSponsor')->name('search_sponsor' )->middleware('checkip');

  //Perfil
  Route::get('/perfil',            'App\Perfil\PerfilController@index')->name('profile')->middleware('checkip');
  Route::post('/perfil-guardar',   'App\Perfil\PerfilController@store')->name('profile-save')->middleware('checkip');

  //Validaciones
  Route::post('/phoneValidExists',   'ValidacionAjaxController@phoneValidExists')->middleware('checkip');
  Route::post('/usuarioValidExists', 'ValidacionAjaxController@usuarioValidExists')->middleware('checkip');

  //Red
  Route::post ('/red-save',           'App\Red\RedController@store'               )->name('red-save')->middleware('checkip');

  //Cambiar contraseñarray
  Route::get  ('/clave',              'App\Perfil\PerfilController@changePassword')->name('pass')->middleware('checkip');
  Route::post ('/clave-save',         'App\Perfil\PerfilController@savingPassword')->name('pass-change')->middleware('checkip');

  //View Red
  Route::get('/redDetalles',              'App\Red\TreeController@index')->name('red-list')->middleware('checkip');
  Route::post('/red-informacion',         'App\Red\TreeController@getData')->name('red-get-list')->middleware('checkip');
  Route::get('/red-view-circular',        'App\Red\TreeController@viewRedCircular')->name('red-view-circular')->middleware('checkip');
  Route::post('/red-view-circular',       'App\Red\TreeController@getRed')->name('red-get-circular')->middleware('checkip');
  Route::get('/red-view-clasico',         'App\Red\TreeController@viewRedClasico')->name('red-view-clasico')->middleware('checkip');
  Route::post('/busquedaUsuarioSimple', 'App\RedDetalles\RedDetallesController@busquedaUsuarioSimple');

  //Reclamaciones vista oficina virtual
	Route::get('/pqrs2',             'api\freshdesk\freshdeskController2@index2');
	Route::post('/api/freshdesk',    'api\freshdesk\freshdeskController@apiFreshdesk');
	Route::post('/ofvalidate/user',  'api\freshdesk\freshdeskController2@getByUsernameOV');



});

//SELECTS DEPENDIENTES
Route::match(['get', 'post'], '/departament/{id}', 'Panel\DepartamentController@get')->name('departaments.get')->middleware('checkip');
Route::match(['get', 'post'], '/city/{id}',        'Panel\CityController@get'       )->name('cities.get'      )->middleware('checkip');
Route::match(['get', 'post'], '/distrito/{id}',    'Panel\DistritoController@get'   )->name('distritos.get'   )->middleware('checkip');
//SELECTS DEPENDIENTES
