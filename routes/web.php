<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\SIS_GestionController;
use App\Http\Controllers\HistoryController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;

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


Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [HomeController::class, 'home'])->name('index');

	Route::get('dashboard', function () {
		return view('dashboard');
	})->name('dashboard');

	Route::get('billing', function () {
		return view('billing');
	})->name('billing');

	Route::get('perfil', function () {
		return view('perfil');
	})->name('perfil');


	Route::get('rtl', function () {
		return view('rtl');
	})->name('rtl');

	Route::get('user-management', function () {
		return view('laravel-examples/user-management');
	})->name('user-management');

	Route::get('tables', function () {
		return view('tables');
	})->name('tables');

    Route::get('virtual-reality', function () {
		return view('virtual-reality');
	})->name('virtual-reality');

    Route::get('static-sign-in', function () {
		return view('static-sign-in');
	})->name('sign-in');

    Route::get('static-sign-up', function () {
		return view('static-sign-up');
	})->name('sign-up');

    Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
    Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');

	Route::get('MenuSideBar', [MenuController::class, 'MenuSideBar'])->name('MenuSideBar');
	Route::get('mantenedores/mantenedor_usuario', [InfoUserController::class, 'mantenedor_usuario'])->name('mantenedor_usuario');
	Route::get('mantenedores/mantenedor_perfil', [RolController::class, 'mantenedor_perfil'])->name('mantenedor_perfil');
	Route::get('mantenedores/mantenedor_menu', [MenuController::class, 'mantenedor_menu'])->name('mantenedor_menu');
	Route::get('/getMenu', [MenuController::class, 'getMenu'])->name('getMenu');
	Route::get('obtenerOrden', [MenuController::class, 'obtenerOrden'])->name('obtenerOrden');
	Route::get('findMenu', [MenuController::class, 'findMenu'])->name('findMenu');
	Route::get('reportes/dipres', [SIS_GestionController::class, 'reporteInfomeDipres_2022'])->name('informe_dipres');
	Route::get('reportes/transparencia_honoria', [SIS_GestionController::class, 'reporteInformeTransparenciaHonorarios'])->name('transparencia_honorarios');
	Route::get('reportes/horas_extras', [SIS_GestionController::class, 'informe_hora_extra'])->name('horas_extras'); 
	
});



Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});
		

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');




Route::get('/getAllUsers', [InfoUserController::class, 'getAll'])->name('getAllUsers');
Route::get('/findUser', [InfoUserController::class, 'findUser'])->name('findUser');
Route::get('/getRoles', [RolController::class, 'getRoles'])->name('getRoles');
Route::get('/getPrivilegiosRoles', [RolController::class, 'getPrivilegiosRoles'])->name('getPrivilegiosRoles');
Route::get('/addRole', [RolController::class, 'addRole'])->name('addRole');


Route::get('/delete_user', [InfoUserController::class, 'delete_user'])->name('delete_user');
Route::get('/save_user', [InfoUserController::class, 'save_user'])->name('save_user');
Route::get('/update_user', [InfoUserController::class, 'update_user'])->name('update_user');

Route::get('/delete_menu', [MenuController::class, 'delete_menu'])->name('delete_menu');
Route::get('/findMenu', [MenuController::class, 'findMenu'])->name('findMenu');

Route::get('/getinformeDipres_2022', [SIS_GestionController::class, 'informeDipres_2022'])->name('getinformeDipres_2022');

Route::get('excel_informe_dipres/', [SIS_GestionController::class, 'excelInformeDipres'])->name('excel_informe_dipres');
Route::get('/getinforme_transparencia_honorarios', [SIS_GestionController::class, 'informe_transparencia_honorarios'])->name('getinforme_transparencia_honorarios');

Route::get('excel_informe_transparencia_honorarios', [SIS_GestionController::class, 'excelInformeTransparenciaHonorarios'])->name('excel_informe_transparencia_honorarios');

Route::get('getMes', [SIS_GestionController::class, 'getMes'])->name('getMes'); 
Route::get('getDireccion', [SIS_GestionController::class, 'getDireccion'])->name('getDireccion'); 
Route::get('getInfomeHoraExtra', [SIS_GestionController::class, 'getInfomeHoraExtra'])->name('getInfomeHoraExtra'); 
Route::get('excelInformeHorasExtras', [SIS_GestionController::class, 'excelInformeHorasExtras'])->name('excelInformeHorasExtras');
Route::get('save_menu', [MenuController::class, 'save_menu'])->name('save_menu');
Route::get('editar_menu', [MenuController::class, 'editar_menu'])->name('editar_menu');
Route::get('getMenuPadre', [MenuController::class, 'getMenuPadre'])->name('getMenuPadre');
Route::get('obtenerMenuHijo', [MenuController::class, 'obtenerMenuHijo'])->name('obtenerMenuHijo');
Route::get('getPrivilegios', [RolController::class, 'getPrivilegios'])->name('getPrivilegios');
Route::get('/delete_rol', [RolController::class, 'eliminarRol'])->name('delete_rol');

Route::get('profile', function () {
	return view('profile');
})->name('profile');

Route::get('changeContrasena', [InfoUserController::class, 'changeContrasena'])->name('changeContrasena');
Route::get('correoCrearUsuario', [InfoUserController::class, 'correoCrearUsuario'])->name('correCrearUsuario');
Route::get('getHistory', [HistoryController::class, 'getHistory'])->name('getHistory');
Route::get('MenuTreeRol', [MenuController::class, 'menuTreeRol'])->name('MenuTreeRol');