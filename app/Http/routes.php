<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/','AdminController@index');
Route::auth();

// Vistas
Route::get('/home', 'HomeController@index');
Route::get('secretario','HomeController@secretario');
Route::get('secretariocitas','HomeController@secretariocitas');
Route::get('reportes','HomeController@indexReportes');
Route::get('mostrarReporte','HomeController@mostrarReporte');
Route::get('reporteReceta','HomeController@reporteReceta');
Route::get('busquedaRapida','HomeController@indexbusquedaRapida');
Route::post('loginadmin','AdminController@loginadmin');
Route::get('citas','HomeController@indexCitas');
Route::get('historial','HomeController@indexHistorial');
Route::get('formPaciente','PacienteController@formPaciente');
Route::get('realizarCita','CitasController@realizarCita');
Route::get('realizarCitaSecretario','CitasController@realizarCitaSecretario');
Route::get('realizarReceta','RecetasController@realizarReceta');
Route::get('realizarHistorial','HistorialController@realizarHistorial');
Route::get('recetas','HomeController@recetas');
Route::get('saveItemReceta','RecetasController@saveItemReceta');
Route::get('saveItemOdontograma','RecetasController@saveItemOdontograma');
Route::get('formHistorial','HistorialController@formHistorial');
Route::post('insertarExamenFormulario','HistorialController@insertarExamenFormulario');
Route::get('verHistorial','HomeController@verHistorial');


Route::get('odontograma','BusquedaController@odontograma');
Route::get('prueba','BusquedaController@prueba');
Route::post('insertarOdontograma','BusquedaController@insertarOdontograma');
Route::post('updateOdontograma','BusquedaController@updateOdontograma');
Route::get('detalleOdontograma','BusquedaController@detalleOdontograma');
Route::get('nuevoOdontograma','BusquedaController@nuevoOdontograma');







Route::get('formPacienteSecretario','PacienteController@formPacienteSecretario');
Route::get('accesos','HomeController@accesos');
Route::get('formularioUsuario','HomeController@formularioUsuario');
Route::post('registroUsuario','HomeController@registroUsuario');


//Formularios de Update datos
Route::post('modificarPaciente','PacienteController@modificarPaciente');
Route::get('modificarPacienteBuscadoSecretario','PacienteController@modificarPacienteBuscadoSecretario');
Route::get('modificarCita','CitasController@modificarCita');
Route::get('modificarCitaSecretario','CitasController@modificarCitaSecretario');
Route::get('modificarHistorial','HomeController@modificarHistorial');
Route::post('modificarHistorialForm','HistorialController@modificarHistorialForm');

//Update datos
Route::post('updateRegistroPaciente','PacienteController@updateRegistroPaciente');
Route::get('modificarPacienteBuscado','PacienteController@modificarPacienteBuscado');
Route::post('updateRegistroCita','CitasController@updateRegistroCita');
Route::post('updateRegistroCitaSecretario','CitasController@updateRegistroCitaSecretario');
Route::get('modificarReceta','RecetasController@modificarReceta');
Route::post('updateReceta','RecetasController@updateReceta');
Route::post('modificarUsuario','HomeController@modificarUsuario');
Route::post('updateRegistroPacienteSecretario','PacienteController@updateRegistroPacienteSecretario');

//Delete datos
Route::post('eliminarPaciente','PacienteController@eliminarPaciente');
Route::get('eliminarPacienteBuscado','PacienteController@eliminarPacienteBuscado');
Route::get('eliminarCita','CitasController@eliminarCita');
Route::get('eliminarRecetaCuerpo','RecetasController@eliminarRecetaCuerpo');
Route::post('eliminarExamen','HistorialController@eliminarExamen');
Route::post('eliminarUsuario','HomeController@eliminarUsuario');

//Rutas de ingreso de datos
Route::post('registroPaciente','PacienteController@registroPaciente');
Route::post('registroCita','CitasController@registroCita');
Route::post('registroCitaSecretario','CitasController@registroCitaSecretario');
Route::post('registroHistorial','HistorialController@registroHistorial');
Route::post('insertarExamen','HistorialController@insertarExamen');
Route::post('editarUsuario','HomeController@editarUsuario');
Route::post('registroPacienteSecretario','PacienteController@registroPacienteSecretario');
//back
Route::get('back','HomeController@back');

//Rutas de busquedas
Route::get('searchPaciente','BusquedaController@searchPaciente');
Route::get('searchPacienteodontograma','BusquedaController@searchPacienteodontograma');
Route::get('searchPacienteCita','BusquedaController@searchPacienteCita');
Route::get('searchCitas','BusquedaController@searchCitas');
Route::get('searchCitasSecretario','BusquedaController@searchCitasSecretario');
Route::get('searchPacienteReceta','BusquedaController@searchPacienteReceta');
Route::get('searchHistorial','BusquedaController@searchHistorial');
Route::get('searchPacienteHistorial','BusquedaController@searchPacienteHistorial');
Route::get('searchBusquedaRapida','BusquedaController@searchBusquedaRapida');
Route::get('searchReceta','BusquedaController@searchReceta');
Route::get('searchPacienteSecretario','BusquedaController@searchPacienteSecretario');
Route::get('searchPacienteCitaSecretario','BusquedaController@searchPacienteCitaSecretario');
Route::get('getCitasHoy','BusquedaController@getCitasHoy');
Route::get('getCitasMañana','BusquedaController@getCitasMañana');
Route::get('getCitasSemana','BusquedaController@getCitasSemana');
Route::get('getCitasHoySecretario','BusquedaController@getCitasHoySecretario');
Route::get('getCitasMañanaSecretario','BusquedaController@getCitasMañanaSecretario');
Route::get('getCitasSemanaSecretario','BusquedaController@getCitasSemanaSecretario');
