<?php

use App\Appointment;
use App\Pacients;
use App\Doctor;
use Illuminate\Http\Request;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/
Route::get('appointments', 'AppointmentController@index');
Route::get('appointments/{appointments}', 'AppointmentController@show');
Route::post('appointments', 'AppointmentController@store');
Route::put('appointments/{appointments}', 'AppointmentController@update');
Route::delete('appointments/{appointments}', 'AppointmentController@delete');

/*Route::get('pacients', 'PacientsController@index');
Route::get('pacients/{pacients}', 'PacientsController@show');
Route::post('pacients', 'PacientsController@store');
Route::put('pacients/{pacients}', 'PacientsController@update');
Route::delete('pacients/{pacients}', 'PacientsController@delete');

Route::get('doctors', 'DoctorController@index');
Route::get('doctors/{doctors}', 'DoctorController@show');
Route::post('doctors', 'DoctorController@store');
Route::put('doctors/{doctors}', 'DoctorController@update');
Route::delete('doctors/{doctors}', 'DoctorController@delete');
*/
