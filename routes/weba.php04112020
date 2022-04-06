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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();




//rutas del sistema
Route::middleware(['auth'])->group(function(){

   

Route::get('Admin/home', 'HomeController@index')->name('home');
Route::get('Cliente/home', 'HomeController@indexCliente')->name('homeCliente');

//usuarios


route::post('users/store','UserController@store')->name('users.store')->middleware('permission:users.index'); // ruta para ver todos los usuarios
route::get('users','UserController@index')->name('users.index')->middleware('permission:users.index'); // ruta para grabar usuarios nuevos
route::get('users/create','UserController@create')->name('users.create')->middleware('permission:users.create');

route::put('users/{user}','UserController@update')->name('users.update')->middleware('permission:users.update');
route::get('users/{user}','UserController@show')->name('users.show')->middleware('permission:users.index');
route::delete('users/{user}','UserController@destroy')->name('users.destroy')->middleware('permission:users.destroy');
route::get('users/{user}/edit','UserController@edit')->name('users.edit')->middleware('permission:users.edit');//ruta del formulario de edición del rol


//roles
// route::post('roles/store')->name('roles.create')->middleware('permission:roles.create'); // ruta para grabar
route::get('roles','RoleController@index')->name('roles.index')->middleware('permission:roles.index'); // ruta para ver todos los roles
// route::get('roles/create')->name('roles.create')->middleware('permission:roles.create');// ruta formularios de creación
route::put('roles/{user}','RoleController@update')->name('roles.update')->middleware('permission:roles.update');//ruta de actualización del registro
route::get('roles/{user}','RoleController@show')->name('roles.show')->middleware('permission:roles.index');// formulario de solo muestra de información del rol
// route::delete('roles/{user}')->name('roles.destroy')->middleware('permission:roles.destroy');//Ruta de eliminación del rol directamente
route::get('roles/{user}/edit','RoleController@edit')->name('roles.edit')->middleware('permission:roles.edit');//ruta del formulario de edición del rol

//
//Solicitudes Clientes esta mas abajo con nuevos permisos SolicitudesCliente... desactivado el 15/07/2019
// route::post('solicitudes/store','SolicitudesController@store')->name('Solicitudes.create')->middleware('permission:Solicitudes.create'); // ruta para grabar
// route::get('solicitudes','SolicitudesController@index')->name('Solicitudes.index')->middleware('permission:Solicitudes.index'); // ruta para ver todos los roles
// route::get('solicitudes/create','SolicitudesController@create')->name('Solicitudes.create')->middleware('permission:Solicitudes.create');// ruta formularios de creación
// route::put('solicitudes/{user}','SolicitudesController@update')->name('Solicitudes.update')->middleware('permission:Solicitudes.update');//ruta de actualización del registro
// route::get('solicitudes/{user}','SolicitudesController@show')->name('Solicitudes.show')->middleware('permission:Solicitudes.show');// formulario de solo muestra de información del rol
// route::delete('solicitudes/{user}','SolicitudesController@destroy')->name('Solicitudes.destroy')->middleware('permission:Solicitudes.destroy');//Ruta de eliminación del rol directamente
// route::get('solicitudes/{user}/edit','SolicitudesController@edit')->name('Solicitudes.edit')->middleware('permission:Solicitudes.edit');//ruta del formulario de edición del rol

//Menu Inspector
route::get('solicitudes/nuevas','SolicitudesInspectorController@nuevas')->name('SolicitudesNuevas.index')->middleware('permission:SolicitudesFinalizadas.crud'); // ruta para grabar
route::get('solicitudes/finalizadas','SolicitudesInspectorController@finalizadas')->name('SolicitudesFinalizadas.index')->middleware('permission:SolicitudesFinalizadas.crud'); // ruta para grabar

route::post('solicitudes/store','SolicitudesInspectorController@store')->name('SolicitudesInspector.create')->middleware('permission:SolicitudesFinalizadas.crud'); // ruta para grabar
route::get('solicitudes','SolicitudesInspectorController@index')->name('SolicitudesInspector.index')->middleware('permission:SolicitudesFinalizadas.crud'); // ruta para ver todos los roles
route::get('solicitudes/create','SolicitudesInspectorController@create')->name('solicitudesInpector.create')->middleware('permission:SolicitudesFinalizadas.crud');// ruta formularios de creación
route::put('solicitudes/{user}','SolicitudesInspectorController@update')->name('SolicitudesInspector.update')->middleware('permission:SolicitudesFinalizadas.crud');//ruta de actualización del registro
route::get('solicitudes/{user}','SolicitudesInspectorController@show')->name('SolicitudesInspector.show')->middleware('permission:solicitudesInpector.index');// formulario de solo muestra de información del rol
route::delete('solicitudes/{user}','SolicitudesInspectorController@destroy')->name('solicitudesInpector.destroy')->middleware('permission:SolicitudesFinalizadas.crud');//Ruta de eliminación del rol directamente
route::get('solicitudes/{user}/edit','SolicitudesInspectorController@edit')->name('SolicitudesInspector.edit')->middleware('permission:SolicitudesFinalizadas.crud');//ruta del formulario de edición del rol

//Roles Profiles
route::post('rolesProfile/store','RolesProfilesController@store')->name('rolesprofiles.store')->middleware('permission:rolesprofiles.create'); // ruta para grabar
route::get('rolesProfile','RolesProfilesController@index')->name('rolesprofiles.index')->middleware('permission:rolesprofiles.index'); // ruta para ver todos los roles
route::get('rolesProfile/create','RolesProfilesController@create')->name('rolesprofiles.create')->middleware('permission:rolesprofiles.create');// ruta formularios de creación
route::put('rolesProfile/{role}','RolesProfilesController@update')->name('rolesprofiles.update')->middleware('permission:rolesprofiles.update');//ruta de actualización del registro
route::get('rolesProfile/{role}','RolesProfilesController@show')->name('rolesprofiles.show')->middleware('permission:rolesprofiles.show');// formulario de solo muestra de información del rol
route::delete('rolesProfile/{role}','RolesProfilesController@destroy')->name('rolesprofiles.destroy')->middleware('permission:rolesprofiles.destroy');//Ruta de eliminación del rol directamente
route::get('rolesProfile/{role}/edit','RolesProfilesController@edit')->name('rolesprofiles.edit')->middleware('permission:rolesprofiles.edit');//ruta del formulario de edición del rol

//Empresas
route::post('empresas/store','EmpresasController@store')->name('empresas.store')->middleware('permission:empresas.create'); // ruta para grabar
route::get('empresas','EmpresasController@index')->name('empresas.index')->middleware('permission:empresas.index'); // ruta para ver todos los roles
route::get('empresas/create','EmpresasController@create')->name('empresas.create')->middleware('permission:empresas.create');// ruta formularios de creación
route::put('empresas/{empresa}','EmpresasController@update')->name('empresas.update')->middleware('permission:empresas.update');//ruta de actualización del registro
route::get('empresas/{id}','EmpresasController@show')->name('empresas.show')->middleware('permission:empresas.show');// formulario de solo muestra de información del rol
route::delete('empresas/{empresa}','EmpresasController@destroy')->name('empresas.destroy')->middleware('permission:empresas.destroy');//Ruta de eliminación del rol directamente
route::get('empresas/{empresa}/edit','EmpresasController@edit')->name('empresas.edit')->middleware('permission:empresas.edit');//ruta del formulario de edición del rol

//Proyectos
route::post('proyectos/store','ProyectosController@store')->name('proyectos.store')->middleware('permission:proyectos.create'); // ruta para grabar
route::get('proyectos','ProyectosController@index')->name('proyectos.index')->middleware('permission:proyectos.index'); // ruta para ver todos los roles
route::get('proyectos/create','ProyectosController@create')->name('proyectos.create')->middleware('permission:proyectos.create');// ruta formularios de creación
route::put('proyectos/{proyecto}','ProyectosController@update')->name('proyectos.update')->middleware('permission:proyectos.update');//ruta de actualización del registro
route::get('proyectos/{id}','ProyectosController@show')->name('proyectos.show')->middleware('permission:proyectos.show');// formulario de solo muestra de información del rol
route::delete('proyectos/{proyecto}','ProyectosController@destroy')->name('proyectos.destroy')->middleware('permission:proyectos.destroy');//Ruta de eliminación del rol directamente
route::get('proyectos/{proyecto}/edit','ProyectosController@edit')->name('proyectos.edit')->middleware('permission:proyectos.edit');//ruta del formulario de edición del rol
//Estructuras
route::post('estructuras/store','EstructurasController@store')->name('estructuras.store')->middleware('permission:estructuras.create'); // ruta para grabar
route::get('estructuras','EstructurasController@index')->name('estructuras.index')->middleware('permission:estructuras.index'); // ruta para ver todos los roles
route::get('estructuras/create','EstructurasController@create')->name('estructuras.create')->middleware('permission:estructuras.create');// ruta formularios de creación
route::put('estructuras/{empresa}','EstructurasController@update')->name('estructuras.update')->middleware('permission:estructuras.update');//ruta de actualización del registro
route::get('estructuras/{id}','EstructurasController@show')->name('estructuras.show')->middleware('permission:estructuras.show');// formulario de solo muestra de información del rol
route::delete('estructuras/{empresa}','EstructurasController@destroy')->name('estructuras.destroy')->middleware('permission:estructuras.destroy');//Ruta de eliminación del rol directamente
route::get('estructuras/{empresa}/edit','EstructurasController@edit')->name('estructuras.edit')->middleware('permission:estructuras.edit');//ruta del formulario de edición del rol
//Formularios
route::post('formularios/store','FormulariosController@store')->name('formularios.store')->middleware('permission:formularios.create'); // ruta para grabar
route::get('formularios','FormulariosController@index')->name('formularios.index')->middleware('permission:formularios.index'); // ruta para ver todos los roles
route::get('formularios/create','FormulariosController@create')->name('formularios.create')->middleware('permission:formularios.create');// ruta formularios de creación
route::put('formularios/{empresa}','FormulariosController@update')->name('formularios.update')->middleware('permission:formularios.update');//ruta de actualización del registro
route::get('formularios/{id}','FormulariosController@show')->name('formularios.show')->middleware('permission:formularios.show');// formulario de solo muestra de información del rol
route::delete('formularios/{empresa}','FormulariosController@destroy')->name('formularios.destroy')->middleware('permission:formularios.destroy');//Ruta de eliminación del rol directamente
route::get('formularios/{empresa}/edit','FormulariosController@edit')->name('formularios.edit')->middleware('permission:formularios.edit');//ruta del formulario de edición del rol

//usuario de contratistas para certificar
route::post('usuconforms/store','UsucontformsController@store')->name('usuconforms.store')->middleware('permission:usuconforms.create'); // ruta para grabar
route::get('usuconforms','UsucontformsController@index')->name('usuconforms.index')->middleware('permission:usuconforms.index'); // ruta para ver todos los roles
route::get('usuconforms/create','UsucontformsController@create')->name('usuconforms.create')->middleware('permission:usuconforms.create');// ruta formularios de creación
route::put('usuconforms/{id}','UsucontformsController@update')->name('usuconforms.update')->middleware('permission:usuconforms.update');//ruta de actualización del registro
route::get('usuconforms/{usuconfor}','UsucontformsController@show')->name('usuconforms.show')->middleware('permission:usuconforms.show');// formulario de solo muestra de información del rol
route::delete('usuconforms/{usuconfor}','UsucontformsController@destroy')->name('usuconforms.destroy')->middleware('permission:usuconforms.destroy');//Ruta de eliminación del rol directamente
route::get('usuconforms/{usuconfor}/edit','UsucontformsController@edit')->name('usuconforms.edit')->middleware('permission:usuconforms.edit');//ruta del formulario de edición del rol

//solicitudes Cliente 
//solicitudes Cliente de Certificación

route::post('solicitudeCliente/store','SolicitudesController@store')->name('solicitudesCliente.store')->middleware('permission:solicitudesClienteEnviadas.crud'); // ruta para grabar
route::get('solicitudeCliente','SolicitudesController@index')->name('solicitudesCliente.index')->middleware('permission:solicitudesClienteEnviadas.crud'); // ruta para ver todos los roles
route::get('solicitudeCliente/create','SolicitudesController@create')->name('solicitudesCliente.create')->middleware('permission:solicitudesClienteEnviadas.crud');// ruta formularios de creación
//route::put('solicitudeCliente/{role}','RolesProfilescontroller@update')->name('rolesprofiles.update')->middleware('permission:solicitudesClienteEnviadas.crud');//ruta de actualización del registro
route::get('solicitudeCliente/{role}','SolicitudesController@show')->name('solicitudesCliente.show')->middleware('permission:solicitudesCliente.index');// formulario de solo muestra de información del rol
//route::delete('rolesProfile/{role}','RolesProfilescontroller@destroy')->name('rolesprofiles.destroy')->middleware('permission:solicitudesClienteEnviadas.crud');//Ruta de eliminación del rol directamente
route::get('solicitudeCliente/{role}/edit','SolicitudesController@edit')->name('solicitudesCliente.edit')->middleware('permission:solicitudesClienteEnviadas.crud');//ruta del formulario de edición del rol
route::get('formularioCertificacion/{id}/crear','SolicitudesController@CrearFormulario')->name('solicitudesCliente.formulario')->middleware('permission:solicitudesClienteEnviadas.crud');//ruta del formulario de edición del rol

route::get('solicitudeClienteEnviadas','SolicitudesController@indexEnviadas')->name('solicitudesClienteEnviadas.index')->middleware('permission:solicitudesCliente.index'); // ruta para ver todos los roles
route::get('solicitudeClienteGuardadas','SolicitudesController@indexAprobGuard')->name('solicitudesClienteGuardadas.index')->middleware('permission:solicitudesClienteEnviadas.crud'); // ruta para ver todos los roles

route::get('solicitudeAdminContratistas','SolicitudesController@solicitudesAdminContratistas')->name('solicitudesClienteAdmin.index')->middleware('permission:solicitudesCliente.index'); // ruta para ver todos los roles


//fin solicitudes Cliente

//solicitudes Administrador

route::get('solicitudesAdmin','solicitudesAdminController@index')->name('admsol.index')->middleware('permission:admsol.index'); // ruta para ver todos los roles
//route::get('solicitudesAdmin/create','solicitudesAdminController@create')->name('solicitudesCliente.create')->middleware('permission:solicitudesCliente.create');// ruta formularios de creación
route::put('solicitudesAdmin/{role}','solicitudesAdminController@update')->name('admsol.update')->middleware('permission:admsol.update');//ruta de actualización del registro
route::get('solicitudesAdmin/{role}','solicitudesAdminController@show')->name('admsol.show')->middleware('permission:admsol.show');// formulario de solo muestra de información del rol
route::delete('solicitudesAdmin/{role}','solicitudesAdminController@destroy')->name('admsol.destroy')->middleware('permission:admsol.destroy');//Ruta de eliminación del rol directamente
route::get('solicitudesAdmin/{role}/edit','solicitudesAdminController@edit')->name('admsol.edit')->middleware('permission:admsol.edit');//ruta del formulario de edición del rol

route::get('solicitudesAdminAprobadas','solicitudesAdminController@Aprobar')->name('admsolAprobadas.index')->middleware('permission:admsol.edit');//ruta del formulario de edición del rol
route::put('solicitudesAdmin/{role}','solicitudesAdminController@update')->name('admsol.update')->middleware('permission:admsol.update');//ruta de actualización del registro
route::get('solicitudesAdminAprobadasLiberadas','solicitudesAdminController@Liberadas')->name('admsolAprobadasLiberadas.index')->middleware('permission:admsol.index');//ruta del formulario de edición del rol

route::get('ccolp/porfechas','solicitudesAdminController@ccolpxfechasForm')->name('ccolpxfechas.form');
route::post('ccolp/fechasreporte','solicitudesAdminController@ccolpxfechasReporte')->name('ccolpxfechas.reporte');

//fin solicitudes Cliente

route::get('bitacora/{role}/edit','SolicitudesController@bitacora')->name('bitacora.index');//ruta del formulario de edición del rol

route::get('solicitudeClienteGuardadas/{id}/enviar','SolicitudesController@solicitudGuardadaEnviar')->name('solicitudesCliente.guardada')->middleware('permission:solicitudesClienteGuardadas.index'); // ruta para ver todos los roles

route::post('solicitudeCliente/storeGuardada','SolicitudesController@storeGuardada')->name('solicitudesClienteGuardada.store')->middleware('permission:solicitudesCliente.create'); // ruta para grabar


//comprimir y Descargar
route::get('zip/{id}','ComprimirDescargar@comprimirD')->name('comprimir.descargar');

//cargas masiva por excel
route::get('carga/usuario','cargaMasivaController@cargamasivausuarios')->name('cargaMasivaUsuario.carga');
Route::post('/import-excel-asigna-a-area', 'cargaMasivaController@importUser');

route::get('carga/empresa','cargaMasivaController@cargamasivaempresas')->name('cargaMasivaEmpresas.carga');
Route::post('/importEmpresas', 'cargaMasivaController@importEmpresas');


});