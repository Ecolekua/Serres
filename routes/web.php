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
route::post('password/nueva','UserController@passwordnueva')->name('password.nueva');
route::post('nuevaPassword','UserController@nuevaPassword')->name('nuevaPassword.nueva');
Auth::routes();

route::get('zohoUpload/','solicitudesAdminController@zoho')->name('zoho');
route::get('volcadozohoUpload/','solicitudesAdminController@zohovolcado')->name('zohovolcado');

Route::get('zoholaravel/','solicitudesAdminController@zoholaravel');   // solicitudes en tabla zoho,
Route::get('zoholaravel/save','solicitudesAdminController@zoholaravelSave');   // crear archivo en el disco del server,

Route::get('zoholaravel/2019','solicitudesAdminController@zoholaravel2018');   // solicitudes en tabla zoho

Route::get('zohoserresve/','solicitudesAdminController@zohoSerresve'); // certificados generados por laravel
Route::get('zohoserresve/save','solicitudesAdminController@zohoSerresveSave'); // certificados generados por laravel

Route::get('zohoDotacion/','solicitudesAdminController@reporteDotacion'); // trabajadores desde planillacertificado
Route::get('zohoDotacion/save','solicitudesAdminController@reporteDotacionSave');



Route::get('prueba/certificado','solicitudesAdminController@pruebaCertificado');
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
route::get('users/{user}/edit','UserController@edit')->name('users.edit')->middleware('permission:users.edit');//ruta del formulario de edici??n del rol

//roles
// route::post('roles/store')->name('roles.create')->middleware('permission:roles.create'); // ruta para grabar
route::get('roles','RoleController@index')->name('roles.index')->middleware('permission:roles.index'); // ruta para ver todos los roles
// route::get('roles/create')->name('roles.create')->middleware('permission:roles.create');// ruta formularios de creaci??n
route::put('roles/{user}','RoleController@update')->name('roles.update')->middleware('permission:roles.update');//ruta de actualizaci??n del registro
route::get('roles/{user}','RoleController@show')->name('roles.show')->middleware('permission:roles.index');// formulario de solo muestra de informaci??n del rol
// route::delete('roles/{user}')->name('roles.destroy')->middleware('permission:roles.destroy');//Ruta de eliminaci??n del rol directamente
route::get('roles/{user}/edit','RoleController@edit')->name('roles.edit')->middleware('permission:roles.edit');//ruta del formulario de edici??n del rol

//
//Solicitudes Clientes esta mas abajo con nuevos permisos SolicitudesCliente... desactivado el 15/07/2019
// route::post('solicitudes/store','SolicitudesController@store')->name('Solicitudes.create')->middleware('permission:Solicitudes.create'); // ruta para grabar
// route::get('solicitudes','SolicitudesController@index')->name('Solicitudes.index')->middleware('permission:Solicitudes.index'); // ruta para ver todos los roles
// route::get('solicitudes/create','SolicitudesController@create')->name('Solicitudes.create')->middleware('permission:Solicitudes.create');// ruta formularios de creaci??n
// route::put('solicitudes/{user}','SolicitudesController@update')->name('Solicitudes.update')->middleware('permission:Solicitudes.update');//ruta de actualizaci??n del registro
route::get('solicitudes/{id}','SolicitudesController@show')->name('solicitudes.show');//->middleware('permission:solicitudesClienteEnviadas.crud');// formulario de solo muestra de informaci??n del rol
// route::delete('solicitudes/{user}','SolicitudesController@destroy')->name('Solicitudes.destroy')->middleware('permission:Solicitudes.destroy');//Ruta de eliminaci??n del rol directamente
// route::get('solicitudes/{user}/edit','SolicitudesController@edit')->name('Solicitudes.edit')->middleware('permission:Solicitudes.edit');//ruta del formulario de edici??n del rol

//Menu Inspector
route::get('solicitudes/nuevas','SolicitudesInspectorController@nuevas')->name('SolicitudesNuevas.index')->middleware('permission:SolicitudesFinalizadas.crud'); // ruta para grabar
//route::get('solicitudes/finalizadas','SolicitudesInspectorController@finalizadas')->name('SolicitudesFinalizadas.index');
route::get('solicitud/finalizada','SolicitudesInspectorController@finalizada')->name('SolicitudFinalizada.index');
route::get('solicitudesInspector/{id}/show','SolicitudesInspectorController@show')->name('solicitudesInspector.show')->middleware('permission:SolicitudesFinalizadas.crud');
// inspector certificaci??n
route::get('certificacion/{id}/solicitud','SolicitudesInspectorController@certificacionCreate')->name('CertificarSolicitud.create')->middleware('permission:SolicitudesFinalizadas.crud');
route::post('envio/Solicitud/Certificado/Firma','SolicitudesInspectorController@EnvioSolicitudCertificadoFirma')->name('enviar.firma')->middleware('permission:SolicitudesFinalizadas.crud');

// fin certificaci??n



route::post('solicitudes/store','SolicitudesInspectorController@store')->name('SolicitudesInspector.create')->middleware('permission:SolicitudesFinalizadas.crud'); // ruta para grabar
route::get('solicitudes','SolicitudesInspectorController@index')->name('SolicitudesInspector.index')->middleware('permission:SolicitudesFinalizadas.crud'); // ruta para ver todos los roles
route::get('solicitudes/create','SolicitudesInspectorController@create')->name('solicitudesInpector.create')->middleware('permission:SolicitudesFinalizadas.crud');// ruta formularios de creaci??n
route::put('solicitudes/{user}','SolicitudesInspectorController@update')->name('SolicitudesInspector.update')->middleware('permission:SolicitudesFinalizadas.crud');//ruta de actualizaci??n del registro
route::get('solicitudes/{user}','SolicitudesInspectorController@show')->name('SolicitudesInspector.show')->middleware('permission:solicitudesInpector.index');// formulario de solo muestra de informaci??n del rol
route::delete('solicitudes/{user}','SolicitudesInspectorController@destroy')->name('solicitudesInpector.destroy')->middleware('permission:SolicitudesFinalizadas.crud');//Ruta de eliminaci??n del rol directamente
route::get('solicitudes/{user}/edit','SolicitudesInspectorController@edit')->name('SolicitudesInspector.edit')->middleware('permission:SolicitudesFinalizadas.crud');//ruta del formulario de edici??n del rol
route::get('SolicitudesInspectorObsFirm','SolicitudesInspectorController@SolicitudesInspectorObsFirm')->name('SolicitudesInspectorObsFirm.index')->middleware('permission:SolicitudesFinalizadas.crud');



//Roles Profiles
route::post('rolesProfile/store','RolesProfilesController@store')->name('rolesprofiles.store')->middleware('permission:rolesprofiles.create'); // ruta para grabar
route::get('rolesProfile','RolesProfilesController@index')->name('rolesprofiles.index')->middleware('permission:rolesprofiles.index'); // ruta para ver todos los roles
route::get('rolesProfile/create','RolesProfilesController@create')->name('rolesprofiles.create')->middleware('permission:rolesprofiles.create');// ruta formularios de creaci??n
route::put('rolesProfile/{role}','RolesProfilesController@update')->name('rolesprofiles.update')->middleware('permission:rolesprofiles.update');//ruta de actualizaci??n del registro
route::get('rolesProfile/{role}','RolesProfilesController@show')->name('rolesprofiles.show')->middleware('permission:rolesprofiles.show');// formulario de solo muestra de informaci??n del rol
route::delete('rolesProfile/{role}','RolesProfilesController@destroy')->name('rolesprofiles.destroy')->middleware('permission:rolesprofiles.destroy');//Ruta de eliminaci??n del rol directamente
route::get('rolesProfile/{role}/edit','RolesProfilesController@edit')->name('rolesprofiles.edit')->middleware('permission:rolesprofiles.edit');//ruta del formulario de edici??n del rol

//Empresas
route::post('empresas/store','EmpresasController@store')->name('empresas.store')->middleware('permission:empresas.create'); // ruta para grabar
route::get('empresas','EmpresasController@index')->name('empresas.index')->middleware('permission:empresas.index'); // ruta para ver todos los roles
route::get('empresas/create','EmpresasController@create')->name('empresas.create')->middleware('permission:empresas.create');// ruta formularios de creaci??n
route::put('empresas/{empresa}','EmpresasController@update')->name('empresas.update')->middleware('permission:empresas.update');//ruta de actualizaci??n del registro
route::get('empresas/{id}','EmpresasController@show')->name('empresas.show')->middleware('permission:empresas.show');// formulario de solo muestra de informaci??n del rol
route::delete('empresas/{empresa}','EmpresasController@destroy')->name('empresas.destroy')->middleware('permission:empresas.destroy');//Ruta de eliminaci??n del rol directamente
route::get('empresas/{empresa}/edit','EmpresasController@edit')->name('empresas.edit')->middleware('permission:empresas.edit');//ruta del formulario de edici??n del rol



//Proyectos
route::post('proyectos/store','ProyectosController@store')->name('proyectos.store')->middleware('permission:proyectos.create'); // ruta para grabar
route::get('proyectos','ProyectosController@index')->name('proyectos.index')->middleware('permission:proyectos.index'); // ruta para ver todos los roles
route::get('proyectos/create','ProyectosController@create')->name('proyectos.create')->middleware('permission:proyectos.create');// ruta formularios de creaci??n
route::put('proyectos/{proyecto}','ProyectosController@update')->name('proyectos.update')->middleware('permission:proyectos.update');//ruta de actualizaci??n del registro
route::get('proyectos/{id}','ProyectosController@show')->name('proyectos.show')->middleware('permission:proyectos.show');// formulario de solo muestra de informaci??n del rol
route::delete('proyectos/{proyecto}','ProyectosController@destroy')->name('proyectos.destroy')->middleware('permission:proyectos.destroy');//Ruta de eliminaci??n del rol directamente
route::get('proyectos/{proyecto}/edit','ProyectosController@edit')->name('proyectos.edit')->middleware('permission:proyectos.edit');//ruta del formulario de edici??n del rol
//Estructuras
route::post('estructuras/store','EstructurasController@store')->name('estructuras.store')->middleware('permission:estructuras.create'); // ruta para grabar
route::get('estructuras','EstructurasController@index')->name('estructuras.index')->middleware('permission:estructuras.index'); // ruta para ver todos los roles
route::get('estructuras/create','EstructurasController@create')->name('estructuras.create')->middleware('permission:estructuras.create');// ruta formularios de creaci??n
route::put('estructuras/{empresa}','EstructurasController@update')->name('estructuras.update')->middleware('permission:estructuras.update');//ruta de actualizaci??n del registro
route::get('estructuras/{id}','EstructurasController@show')->name('estructuras.show')->middleware('permission:estructuras.show');// formulario de solo muestra de informaci??n del rol
route::delete('estructuras/{empresa}','EstructurasController@destroy')->name('estructuras.destroy')->middleware('permission:estructuras.destroy');//Ruta de eliminaci??n del rol directamente
route::get('estructuras/{empresa}/edit','EstructurasController@edit')->name('estructuras.edit')->middleware('permission:estructuras.edit');//ruta del formulario de edici??n del rol
route::get('estructuras/propiedades','EstructurasController@EstructuraPropiedades')->name('estructuras.propiedades')->middleware('permission:estructuras.edit');


//Formularios
route::post('formularios/store','FormulariosController@store')->name('formularios.store')->middleware('permission:formularios.create'); // ruta para grabar
route::get('formularios','FormulariosController@index')->name('formularios.index')->middleware('permission:formularios.index'); // ruta para ver todos los roles
route::get('formularios/create','FormulariosController@create')->name('formularios.create')->middleware('permission:formularios.create');// ruta formularios de creaci??n
route::put('formularios/{empresa}','FormulariosController@update')->name('formularios.update')->middleware('permission:formularios.update');//ruta de actualizaci??n del registro
route::get('formularios/{id}','FormulariosController@show')->name('formularios.show')->middleware('permission:formularios.show');// formulario de solo muestra de informaci??n del rol
route::delete('formularios/{empresa}','FormulariosController@destroy')->name('formularios.destroy')->middleware('permission:formularios.destroy');//Ruta de eliminaci??n del rol directamente
route::get('formularios/{empresa}/edit','FormulariosController@edit')->name('formularios.edit')->middleware('permission:formularios.edit');//ruta del formulario de edici??n del rol

//usuario de contratistas para certificar
route::post('usuconforms/store','UsucontformsController@store')->name('usuconforms.store')->middleware('permission:usuconforms.create'); // ruta para grabar
route::get('usuconforms','UsucontformsController@index')->name('usuconforms.index')->middleware('permission:usuconforms.index'); // ruta para ver todos los roles
route::post('usuconforms/busqueda','UsucontformsController@busqueda')->name('usuconforms.busqueda')->middleware('permission:usuconforms.index'); // ruta para ver todos los roles

route::get('usuconforms/create','UsucontformsController@create')->name('usuconforms.create')->middleware('permission:usuconforms.create');// ruta formularios de creaci??n
route::put('usuconforms/{id}','UsucontformsController@update')->name('usuconforms.update')->middleware('permission:usuconforms.update');//ruta de actualizaci??n del registro
route::get('usuconforms/{usuconfor}','UsucontformsController@show')->name('usuconforms.show')->middleware('permission:usuconforms.show');// formulario de solo muestra de informaci??n del rol
route::delete('usuconforms/{usuconfor}','UsucontformsController@destroy')->name('usuconforms.destroy')->middleware('permission:usuconforms.destroy');//Ruta de eliminaci??n del rol directamente
route::get('usuconforms/{usuconfor}/edit','UsucontformsController@edit')->name('usuconforms.edit')->middleware('permission:usuconforms.edit');//ruta del formulario de edici??n del rol

Route::post('estructuras/usuarios','UsucontformsController@asignaestructurausuario')->name('estructuras.usuario')->middleware('permission:usuconforms.create');
//solicitudes Cliente 
//solicitudes Cliente de Certificaci??n.

route::post('solicitudeCliente/store','SolicitudesController@store')->name('solicitudesCliente.store')->middleware('permission:solicitudesClienteEnviadas.crud'); // ruta para grabar
route::get('solicitudeCliente','SolicitudesController@index')->name('solicitudesCliente.index')->middleware('permission:solicitudesClienteEnviadas.crud'); // ruta para ver todos los roles
route::get('solicitudeCliente/create','SolicitudesController@create')->name('solicitudesCliente.create')->middleware('permission:solicitudesClienteEnviadas.crud');// ruta formularios de creaci??n
//route::put('solicitudeCliente/{role}','RolesProfilescontroller@update')->name('rolesprofiles.update')->middleware('permission:solicitudesClienteEnviadas.crud');//ruta de actualizaci??n del registro
route::get('solicitudeCliente/{role}','SolicitudesController@show')->name('solicitudesCliente.show')->middleware('permission:solicitudesCliente.index');// formulario de solo muestra de informaci??n del rol
//route::delete('rolesProfile/{role}','RolesProfilescontroller@destroy')->name('rolesprofiles.destroy')->middleware('permission:solicitudesClienteEnviadas.crud');//Ruta de eliminaci??n del rol directamente
route::get('solicitudeCliente/{role}/edit','SolicitudesController@edit')->name('solicitudesCliente.edit')->middleware('permission:solicitudesClienteEnviadas.crud');//ruta del formulario de edici??n del rol
route::get('formularioCertificacion/{id}/crear','SolicitudesController@CrearFormulario')->name('solicitudesCliente.formulario')->middleware('permission:solicitudesClienteEnviadas.crud');//ruta del formulario de edici??n del rol
route::get('formularioCertificacionDeclaracion/{id}/crear','SolicitudesController@CrearFormularioDeclaracion')->name('solicitudesCliente.formularioDeclaracion')->middleware('permission:solicitudesClienteEnviadas.crud');//ruta del formulario de edici??n del rol
route::get('formularioCertificacionCovid/{id}/crear','SolicitudesController@CrearFormularioCovid')->name('solicitudesCovid.formularioCovid')->middleware('permission:solicitudesClienteEnviadas.crud');//ruta del formulario Covid 19



route::get('solicitudeClienteEnviadas','SolicitudesController@indexEnviadas')->name('solicitudesClienteEnviadas.index')->middleware('permission:solicitudesCliente.index'); // ruta para ver todos los roles
route::get('solicitudeClienteGuardadas','SolicitudesController@indexAprobGuard')->name('solicitudesClienteGuardadas.index');//->middleware('permission:solicitudesClienteEnviadas.crud'); // ruta para ver todos los roles
route::get('solicitudeClienteDeclaradas','SolicitudesController@indexDeclaradas')->name('solicitudesClienteDeclaradas.index');//->middleware('permission:solicitudesClienteEnviadas.crud'); // ruta para ver todos los roles


route::get('solicitudeAdminContratistas','SolicitudesController@solicitudesAdminContratistas')->name('solicitudesClienteAdmin.index');//->middleware('permission:solicitudesClienteEnviadas.crud');//->middleware('permission:solicitudesCliente.index'); // ruta para ver todos los roles
route::get('buscarSolicitudes','SolicitudesController@buscarSolicitudes')->name('buscarSolicitudes.buscador');//->middleware('permission:solicitudesCliente.index');
route::post('resultadoBusqueda','SolicitudesController@ResultadoBusquedaSolicitud')->name('buscarSolicitud.buscador');//->middleware('permission:solicitudesCliente.index');




//fin solicitudes Cliente

//solicitudes Administrador

Route::post('carga/solicitud/inspector','solicitudesAdminController@cargasolicitudesainspectores')->name('carga.inspectoresasolicitudes')->middleware('permission:admsol.index');


route::get('solicitudesAdmin','solicitudesAdminController@index')->name('admsol.index')->middleware('permission:admsol.index'); // ruta para ver todos los roles
//route::get('solicitudesAdmin/create','solicitudesAdminController@create')->name('solicitudesCliente.create')->middleware('permission:solicitudesCliente.create');// ruta formularios de creaci??n
route::put('solicitudesAdmin/{role}','solicitudesAdminController@update')->name('admsol.update')->middleware('permission:admsol.update');//ruta de actualizaci??n del registro
route::get('solicitudesAdmin/{role}','solicitudesAdminController@show')->name('admsol.show')->middleware('permission:admsol.show');// formulario de solo muestra de informaci??n del rol
route::delete('solicitudesAdmin/{role}','solicitudesAdminController@destroy')->name('admsol.destroy')->middleware('permission:admsol.destroy');//Ruta de eliminaci??n del rol directamente
route::get('solicitudesAdmin/{role}/edit','solicitudesAdminController@edit')->name('admsol.edit')->middleware('permission:admsol.edit');//ruta del formulario de edici??n del rol

route::get('solicitudesAdminAprobadas','solicitudesAdminController@Aprobar')->name('admsolAprobadas.index')->middleware('permission:admsol.edit');//ruta del formulario de edici??n del rol
//route::put('solicitudesAdmin/{role}','solicitudesAdminController@update')->name('admsol.update')->middleware('permission:admsol.update');//ruta de actualizaci??n del registro
Route::get('SolicitudesxFecha/','solicitudesAdminController@liberadasFecha')->name('SolicitudesLiberadasxFecha.filtro')->middleware('permission:admsol.index');
Route::post('ResultadoLiberadasxFecha','solicitudesAdminController@resultadolliberadasxfecha')->name('liberadasxfecha.reporte')->middleware('permission:admsol.index');
Route::get('solicitudesAdmin/{id}/Solicitudes','solicitudesAdminController@solicitudesAdminShow')->name('solicitudesAdmin.show')->middleware('permission:admsol.index');


route::get('ccolp/porfechas','solicitudesAdminController@ccolpxfechasForm')->name('ccolpxfechas.form');
route::post('ccolp/fechasreporte','solicitudesAdminController@ccolpxfechasReporte')->name('ccolpxfechas.reporte');

route::get('reasignasolicitud','solicitudesAdminController@reasignaSolicitud')->name('reasignasolicitud.index')->middleware('permission:admsol.index');
route::post('reasignarSolicitud/store','solicitudesAdminController@reasignarSolicitudstore')->name('reasignarSolicitud.store')->middleware('permission:admsol.index');

route::get('buscasolicitudesadmin','solicitudesAdminController@busquedasolicitudes')->name('busquedasolicitudesadmin.index')->middleware('permission:admsol.index');
route::get('eliminasolicitudesadmin','solicitudesAdminController@eliminaolicitudes')->name('eliminarsolicitudesadmin.index')->middleware('permission:admsol.index');
route::post('resultadobusquedaadmin','solicitudesAdminController@resultadobusquedaadmin')->name('resultadobusquedaadmin.store')->middleware('permission:admsol.index');
route::post('eliminabusquedaadmin','solicitudesAdminController@eliminabusquedaadmin')->name('eliminabusquedaadmin.destroy')->middleware('permission:admsol.index');
route::post('anula/solicitudes','solicitudesAdminController@solicitudAnular')->name('solicitud.anular')->middleware('permission:admsol.index');
route::get('asolicitudesAnuladas/','solicitudesAdminController@solicitudesAnuladas')->name('asolicitudesAnuladas.index')->middleware('permission:admsol.index');
route::get('cambiarEstado/Solicitud','solicitudesAdminController@cambiarEstadoSolicitud')->name('cambiarEstado.solicitud')->middleware('permission:admsol.index');
route::post('actualizaEstado/Solicitud','solicitudesAdminController@actualizaEstadoSolicitud')->name('actualizaEstado.solicitud')->middleware('permission:admsol.index');


//fin solicitudes Cliente

route::get('bitacora/{role}/edit','SolicitudesController@bitacora')->name('bitacora.index');//ruta del formulario de edici??n del rol

route::get('solicitudeClienteGuardadas/{id}/enviar','SolicitudesController@solicitudGuardadaEnviar')->name('solicitudesCliente.guardada');//->middleware('permission:solicitudesClienteGuardadas.index'); // ruta para ver todos los roles

route::post('solicitudeCliente/storeGuardada','SolicitudesController@storeGuardada')->name('solicitudesClienteGuardada.store');//->middleware('permission:solicitudesCliente.create'); // ruta para grabar

//documentos del cliente

route::get('Cliente/','SolicitudesController@documentosCliente')->name('documentosCliente.index');



//comprimir y Descargar
route::get('zip/{id}','ComprimirDescargar@comprimirD')->name('comprimir.descargar');
route::post('compresion/archivos','ComprimirDescargar@Comprimir')->name('comprimirArchivos.zipper');//->middleware('permission:admsol.index');
route::post('compresion/archivos/clientes','ComprimirDescargar@ComprimirClientes')->name('comprimirArchivosClientes.zipper');//->middleware('permission:admsol.index');
route::post('compresion/archivos/solicitud','ComprimirDescargar@ComprimirDocumentoSolicitud')->name('comprimirArchivosDocumentos.zipper');//->middleware('permission:admsol.index');


//cargas masiva por excel
route::get('carga/usuario','cargaMasivaController@cargamasivausuarios')->name('cargaMasivaUsuario.carga');
Route::post('/import-excel-asigna-a-area', 'cargaMasivaController@importUser');

route::get('carga/inspectorasolicitudes','solicitudesAdminController@asignacionsolicitudesInspectores')->name('asigancionsolicitudes.inspector');


route::get('carga/empresa','cargaMasivaController@cargamasivaempresas')->name('cargaMasivaEmpresas.carga');
Route::post('/importEmpresas', 'cargaMasivaController@importEmpresas');

Route::get('carga/facturas','cargaMasivaController@cargamasivafacturas')->name('cargaMasivaFactura.carga');
Route::post('/import-excel-asigna-facturas', 'cargaMasivaController@importFact');

//route::get('carga/usuario','cargaMasivaController@cargamasivausuarios')->name('cargaMasivaUsuario.carga');
Route::post('/import-excel-asigna-trabajador-certificado', 'cargaMasivaController@ImportJobs');

//tags
//Route::get('AdministradorTags/','TagsController@')
Route::get('Administracion/Tags','TagsController@index')->name('tags.index')->middleware('permission:admsol.index');
Route::get('/crear/tags','TagsController@create')->name('tags.create')->middleware('permission:admsol.index');
Route::post('/tgas/store','TagsController@store')->name('tags.store')->middleware('permission:admsol.index');
Route::get('/tags/{id}/edit','TagsController@edit')->name('tags.edit')->middleware('permission:admsol.index');
route::post('/tags/saved','TagsController@update')->name('tags.update')->middleware('permission:admsol.index');//ruta de actualizaci??n del registro

//Documentos

Route::get('/indexArchivos','DocumentosController@index')->name('documentos.index')->middleware('permission:SolicitudesFinalizadas.crud');
Route::get('/carga/documentos','DocumentosController@create')->name('documentos.create')->middleware('permission:SolicitudesFinalizadas.crud');
Route::post('/users/fileupload/','DocumentosController@store')->name('users.fileupload');
Route::get('/editar/{id}/documentos','DocumentosController@edit')->name('documentos.edit')->middleware('permission:SolicitudesFinalizadas.crud');
Route::post('/update/documentos','DocumentosController@update')->name('documentos.update')->middleware('permission:SolicitudesFinalizadas.crud');
Route::get('/cargas/e/informes/documentos','DocumentosController@cargaeinformes')->name('cargaeinformes.index')->middleware('permission:SolicitudesFinalizadas.crud');

//GroupsTags

Route::get('/groups/tags','GroupTagsController@index')->name('group.index')->middleware('permission:admsol.index');
Route::get('/groups/create','GroupTagsController@create')->name('group.create')->middleware('permission:admsol.index');
Route::post('/group/saved','GroupTagsController@store')->name('group.store')->middleware('permission:admsol.index');

//certificados
Route::get('/emision/certificados','CertificadoController@index')->name('certificado.index')->middleware('permission:admsol.index');
Route::post('carga/empleado/','SolicitudesInspectorController@CargaEmpleados')->name('carga.empleados')->middleware('permission:admsol.index');



Route::post('revision/certificado','SolicitudesInspectorController@revisionCertificado')->name('certificado.revision')->middleware('permission:admsol.index');
Route::post('/rechazo/Certificado','SolicitudesInspectorController@rechazoCertificado')->name('rechazo.certificado')->middleware('permission:admsol.index');
Route::post('/firma/Certificado','solicitudesAdminController@firmaCertificado')->name('firma.certificado')->middleware('permission:admsol.index');
Route::post('/ver/Certificado','SolicitudesInspectorController@verCertificado')->name('ver.certificado')->middleware('permission:admsol.index');
Route::post('/certificado/rechazado','SolicitudesInspectorController@certificadoRechazadoEdicion')->name('certificado.rechazado.edicion')->middleware('permission:SolicitudesFinalizadas.crud');
Route::post('/elimina/certificado','solicitudesAdminController@eliminaCertificado')->name('eliminar.certificado')->middleware('permission:admsol.index');
Route::post('/enviar/x/rechazo','SolicitudesInspectorController@enviarXrechazo')->name('enviar.firmaXrechazo')->middleware('permission:SolicitudesFinalizadas.crud');
Route::post('/certificado/reemplazo','SolicitudesInspectorController@certificadoReemplazo')->name('carga.empleadosReemplazo')->middleware('permission:SolicitudesFinalizadas.crud');
Route::post('/certificado/reemplazo/revision','SolicitudesInspectorController@enviarCertificadoReemplazoRevision')->name('enviar.CertificadoReemplazoRevision')->middleware('permission:SolicitudesFinalizadas.crud');
Route::post('/firma/Certificado/Reemplazo','solicitudesAdminController@firmaCertificadoReemplazo')->name('firma.certificado.reemplazo')->middleware('permission:admsol.index');
Route::post('/rechazo/cdrtificado/reemplazo','SolicitudesInspectorController@rechazosolicitudreemplazo')->name('rechazo.certificadoReemplazo')->middleware('permission:admsol.index');
});