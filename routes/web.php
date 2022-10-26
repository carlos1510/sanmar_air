<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

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

Route::get('/', 'App\Http\Controllers\HomeController@viewLogin');
Route::get('/home', 'App\Http\Controllers\HomeController@viewHome');
Route::get('/vuelos', 'App\Http\Controllers\HomeController@viewFligth');
Route::get('/empresa', 'App\Http\Controllers\HomeController@viewCompany');
Route::get('/usuario', 'App\Http\Controllers\HomeController@viewUser');
Route::get('/administrar_vuelo', 'App\Http\Controllers\HomeController@viewManageFligth');
Route::get('/reservados', 'App\Http\Controllers\HomeController@viewReserved');
Route::get('/proforma', 'App\Http\Controllers\HomeController@viewReportProforma');

// Rutas Usuarios
Route::post('usuario/login', 'App\Http\Controllers\UserController@login');
Route::get('usuario/logout', 'App\Http\Controllers\UserController@logout');
Route::post('usuario/registrarUsuario', 'App\Http\Controllers\UserController@registrarUsuario');
Route::post('usuario/eliminarUsuario', 'App\Http\Controllers\UserController@eliminarUsuario');
Route::post('usuario/listarUsuarios', 'App\Http\Controllers\UserController@listarUsuarios');
Route::post('usuario/quitarAccesoUsuario', 'App\Http\Controllers\UserController@quitarAccesoUsuario');

// Rutas Empresa
Route::post('empresa/registrarEmpresa', 'App\Http\Controllers\CompanyController@registrarEmpresa');
Route::post('empresa/eliminarEmpresa', 'App\Http\Controllers\CompanyController@eliminarEmpresa');
Route::post('empresa/listarEmpresa', 'App\Http\Controllers\CompanyController@listarEmpresa');

// Rutas Vuelos
Route::post('vuelos/getRutasVuelos', 'App\Http\Controllers\FligthController@getRutasVuelos');
Route::post('vuelos/guardarPasajePaciente', 'App\Http\Controllers\FligthController@guardarPasajePaciente');
Route::post('vuelos/listarPasajesPaciente', 'App\Http\Controllers\FligthController@listarPasajesPaciente');
Route::post('vuelos/listarPasajesReservadosEmpresa', 'App\Http\Controllers\FligthController@listarPasajesReservadosEmpresa');
Route::post('vuelos/guardarConfirmarReservaPasaje', 'App\Http\Controllers\FligthController@guardarConfirmarReservaPasaje');
Route::post('vuelos/obtenerListaAcompanantes', 'App\Http\Controllers\FligthController@obtenerListaAcompanantes');
Route::post('vuelos/listarPasajesReservados', 'App\Http\Controllers\FligthController@listarPasajesReservados');

// Rutas Paciente
Route::post('paciente/registrarPaciente', 'App\Http\Controllers\PatientController@registrarPaciente');
Route::post('paciente/eliminarPaciente', 'App\Http\Controllers\PatientController@eliminarPaciente');
Route::post('paciente/listarPaciente', 'App\Http\Controllers\PatientController@listarPaciente');
Route::post('paciente/buscarPersonaDocumento', 'App\Http\Controllers\PatientController@buscarPersonaDocumento');

// Rutas Reportes
Route::post('reporte/reporteSeguimiento', 'App\Http\Controllers\ReportTracingController@reporteSeguimiento');


