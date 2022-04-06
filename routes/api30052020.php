<?php

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EstructurasController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/eliminar/{id}/User/','UserController@destroy');
Route::get('/eliminar/{id}/Role/','RolesProfilesController@destroy')->name('rolesprofiles.destroy')->middleware('permission:rolesprofiles.destroy');//Ruta de eliminación del rol directamente;
Route::get('/datos/{rut}/Empresa/','EmpresasController@RecuperaDatosEmpresa');
Route::get('/proyectos/{idEmpresa}/empresa/','ProyectosController@proyectosEmpresa');
Route::get('/Listaproyectos/{id}/empresa','EstructurasController@listaProyectosEmpresa');
Route::get('/eliminar/{id}/Proyecto/','EstructurasController@destroy');
Route::get('/eliminar/{id}/UsuContForm/','UsucontformsController@destroy');
Route::get('/aprobar/{id}/certificado/','solicitudesAdminController@ApruebaCertificado');
Route::get('/rechazar/{id}/certificado/','solicitudesAdminController@RechazaCertificado');
Route::get('/prueba/lista/empresas/','EmpresasController@listaCsharp');