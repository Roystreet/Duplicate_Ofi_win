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
Route::get('/',                        'Auth\LoginController@index')->name('index')->middleware('checkip');
Auth::routes();


Route::group(['middleware' => 'auth', 'checkip'], function(){

  Route::get('/home',              'HomeController@index')->name('home')->middleware('checkip');


    //PANEL RUTAS

    Route::resource('roles',                'Admin\TpRolController');
    Route::resource('sexos',                'Admin\TpSexoController');
    Route::resource('token',                'Admin\TpTokenController');

    Route::resource('ciudad',               'Admin\CityController');
    Route::resource('pais',                 'Admin\CountryController');
    Route::resource('departamento',         'Admin\DepartamentController');

    Route::resource('estatus-sesion',       'Admin\StatusSessionController');
    Route::resource('estatus-usuarios-app', 'Admin\StatusUsersAppController');
    Route::resource('estatus-red',          'Admin\StatusRedController');
    Route::resource('sesiones',             'Admin\SessionController');

    Route::resource('usuarios-app',         'Admin\UsersAppController');
    Route::resource('rol-usuarios',         'Admin\RolUsersController');
    Route::resource('token-usuarios-app',   'Admin\TokenUsersAppController');

    Route::resource('clave-usuarios-app',   'Admin\PasswordUsersAppController');

    Route::resource('menus',                'Admin\MenuController');
    Route::resource('rol-menus',            'Admin\RolMenuController');
    Route::resource('permisos',             'Admin\PermisoController');
    Route::resource('foto-perfil',          'Admin\PhotoPerfilController');
    Route::resource('red-usuarios',         'Admin\UsersRedController');
    Route::resource('accesos-ip',           'Admin\AccesosIpController');
    Route::resource('distritos',            'Admin\DistritoController');
    Route::resource('foto-perfil',          'Admin\PhotoPerfilController');
    Route::resource('agentes',              'Admin\AgentsController');

    //RUTAS PARA USUARIO INTERNO
    Route::match(['get', 'post'], '/updateStatusDistritos',        'Admin\DistritoController@updateStatus');
    Route::match(['get', 'post'], '/updateStatusAccesosIp',        'Admin\AccesosIpController@updateStatus');
    Route::match(['get', 'post'], '/updateBloqueoAcceso',          'Admin\UsersAppController@updateBloqueoAcceso');
    Route::match(['get', 'post'], '/updateStatusRedUsuarios',      'Admin\UsersRedController@updateStatus');
    Route::match(['get', 'post'], '/updateStatusStatusRed',        'Admin\StatusRedController@updateStatus');
    Route::match(['get', 'post'], '/updateStatusSession',          'Admin\SessionController@updateStatus');
    Route::match(['get', 'post'], '/updateStatusPhotoPerfil',      'Admin\PhotoPerfilController@updateStatus');
    Route::match(['get', 'post'], '/updateStatusPermisos',         'Admin\PermisoController@updateStatus');
    Route::match(['get', 'post'], '/updateStatusRolMenu',          'Admin\RolMenuController@updateStatus');
    Route::match(['get', 'post'], '/updateStatusStatusSession',    'Admin\StatusSessionController@updateStatus');
    Route::match(['get', 'post'], '/updateStatusTpToken',          'Admin\TpTokenController@updateStatus');
    Route::match(['get', 'post'], '/updateStatusTokenUsersApp',    'Admin\TokenUsersAppController@updateStatus');
    Route::match(['get', 'post'], '/updateStatusPasswordUsersApp', 'Admin\PasswordUsersAppController@updateStatus');
    Route::match(['get', 'post'], '/updateStatusRolUsers',         'Admin\RolUsersController@updateStatus');
    Route::match(['get', 'post'], '/updateStatusStatusUsersApp',   'Admin\StatusUsersAppController@updateStatus');
    Route::match(['get', 'post'], '/updateStatusCity',             'Admin\CityController@updateStatus');
    Route::match(['get', 'post'], '/updateStatusDepartament',      'Admin\DepartamentController@updateStatus');
    Route::match(['get', 'post'], '/updateStatusCountry',          'Admin\CountryController@updateStatus');
    Route::match(['get', 'post'], '/updateStatusTpSexo',           'Admin\TpSexoController@updateStatus');
    Route::match(['get', 'post'], '/updateStatusTpRols',           'Admin\TpRolController@updateStatus');
    Route::MATCH(['get', 'post'], '/getPhotoPerfil',               'Admin\PhotoPerfilController@getPhotoPerfil');
    Route::MATCH(['get', 'post'], '/getPermisos',                  'Admin\PermisoController@getPermisos');
    Route::MATCH(['get', 'post'], '/getRolMenu',                   'Admin\RolMenuController@getRolMenu');
    Route::MATCH(['get', 'post'], '/getSession',                   'Admin\SessionController@getSession');
    Route::MATCH(['get', 'post'], '/getStatusSession',             'Admin\StatusSessionController@getStatusSession');
    Route::MATCH(['get', 'post'], '/getTpToken',                   'Admin\TpTokenController@getTpToken');
    Route::MATCH(['get', 'post'], '/getTokenUsersApp',             'Admin\TokenUsersAppController@getTokenUsersApp');
    Route::MATCH(['get', 'post'], '/getPasswordUsersApp',          'Admin\PasswordUsersAppController@getPasswordUsersApp');
    Route::MATCH(['get', 'post'], '/getRolUsers',                  'Admin\RolUsersController@getRolUsers');
    Route::MATCH(['get', 'post'], '/getStatusUsersApp',            'Admin\StatusUsersAppController@getStatusUsersApp');
    Route::MATCH(['get', 'post'], '/getCity',                      'Admin\CityController@getCity');
    Route::MATCH(['get', 'post'], '/getCountry',                   'Admin\CountryController@getCountry');
    Route::MATCH(['get', 'post'], '/getSexo',                      'Admin\TpSexoController@getSexo');
    Route::MATCH(['get', 'post'], '/getTpRols',                    'Admin\TpRolController@getTpRols');
    Route::MATCH(['get', 'post'], '/getRedUsuarios',               'Admin\UsersRedController@getUsersRed')->name('redusuarios.get');
    Route::MATCH(['get', 'post'], '/getStatusRed',                 'Admin\StatusRedController@getStatusRed')    ->name('statusreds.get');
    Route::MATCH(['get', 'post'], '/getUsersApps',                 'Admin\UsersAppController@getUsersApps')     ->name('usersapps.get');
    Route::MATCH(['get', 'post'], '/getMenus',                     'Admin\MenuController@getMenus')             ->name('menus.get');
    Route::MATCH(['get', 'post'], '/getDepartament',               'Admin\DepartamentController@getDepartament')->name('departamet.get');
    Route::MATCH(['get', 'post'], '/getAccesosIp',                 'Admin\AccesosIpController@getAccesosIp')    ->name('accesosips.get');
    Route::MATCH(['get', 'post'], '/getDistritos',                 'Admin\DistritoController@getDistritos')     ->name('distritos.get');

    Route::MATCH(['get', 'post'], '/getAgents',                    'Admin\AgentsController@getAgents')     ->name('agents.get');

    //RUTA PARA ESTATUS GENERALES
    Route::get  ('/estatus',        'Admin\StatusGeneralController@index')->name('estatus');
    //RUTA PARA ESTATUS GENERALES


});

//SELECTS DEPENDIENTES
Route::match(['get', 'post'], '/departament/{id}', 'Admin\DepartamentController@get')->name('departaments.get')->middleware('checkip');
Route::match(['get', 'post'], '/city/{id}',        'Admin\CityController@get'       )->name('cities.get'      )->middleware('checkip');
Route::match(['get', 'post'], '/distrito/{id}',    'Admin\DistritoController@get'   )->name('distritos.get'   )->middleware('checkip');
//SELECTS DEPENDIENTES
