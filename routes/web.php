<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ConsultantController;
use App\Http\Controllers\AppointmentController;
use App\Models\Consultant;

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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('home.index');
})->name('home.index');

Route::get('/consultants/getJson', function () {
    return Consultant::all();
});

Route::resource('/clients', ClientController::class);
Route::resource('/consultants', ConsultantController::class);

Route::get('/appointments/report', [AppointmentController::class, 'report'])->name('appointments.report');
Route::post('/appointments/report_search', [AppointmentController::class, 'report_search'])->name('appointments.report_search');
Route::resource('/appointments', AppointmentController::class);



