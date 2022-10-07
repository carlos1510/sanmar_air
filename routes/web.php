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
Route::get('/paciente', 'App\Http\Controllers\HomeController@viewPatient');
Route::get('/empresa', 'App\Http\Controllers\HomeController@viewCompany');
Route::get('/usuario', 'App\Http\Controllers\HomeController@viewUser');
Route::get('/seguimiento', 'App\Http\Controllers\HomeController@viewTracing');
Route::get('/reporte_seguimiento', 'App\Http\Controllers\HomeController@viewReportTracing');
