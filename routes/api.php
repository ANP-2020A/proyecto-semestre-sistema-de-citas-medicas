<?php

use App\Appointment;
use App\Specialty;
use App\User;
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
Route::get('doctors', 'DoctorController@index');

Route::group(['middleware' => ['cors']], function (){


    Route::post('register', 'UserController@register');
    Route::post('login', 'UserController@authenticate');






    Route::group(['middleware' => ['jwt.verify']], function() {

        Route::get('user', 'UserController@getAuthenticatedUser');
        Route::put('users/{users}', 'UserController@update');

        Route::post('logout', 'UserController@logout');


        Route::get('appointments', 'AppointmentController@index');

        //appointments para ver a a que usuario le pertenece la cita
        Route::get('user/appointments', 'AppointmentController@index');
        Route::get('user/{users}/appointments/{appointments}', 'AppointmentController@show');

        Route::get('appointments/{appointments}', 'AppointmentController@show');
//        Route::get('appointments', 'AppointmentController@show');
        Route::post('appointments', 'AppointmentController@store');
        Route::put('appointments/{appointments}', 'AppointmentController@update');
        Route::delete('appointments/{appointments}', 'AppointmentController@delete');






    });
});
/*
Route::post('register', 'UserController@register');
Route::post('login', 'UserController@authenticate');

Route::get('users', 'UserController@index');
//Route::get('appointments', 'AppointmentController@index');
Route::get('users/{users}', 'UserController@show');


Route::group(['middleware' => ['jwt.verify']], function() {

    Route::get('user', 'UserController@getAuthenticatedUser');
    Route::put('users/{users}', 'UserController@update');



    Route::get('users/{users}/appointments', 'AppointmentController@index');
    Route::get('users/{user}/appointments/{appointments}', 'AppointmentController@show');

    Route::get('appointments/{appointments}', 'AppointmentController@show');
    Route::get('appointments', 'AppointmentController@show');
    Route::post('appointments', 'AppointmentController@store');
    Route::put('appointments/{appointments}', 'AppointmentController@update');
    Route::delete('appointments/{appointments}', 'AppointmentController@delete');




});*/
