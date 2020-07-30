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

Route::post('register', 'UserController@register');
Route::post('login', 'UserController@authenticate');
Route::delete('appointments/{appointments}', 'AppointmentController@delete');

Route::get('users/{user}/appointments', 'CommentController@index');

Route::get('users', 'UserController@index');
Route::get('appointments', 'AppointmentController@index');
Route::get('specialties', 'SpecialtyController@index');

Route::get('users/{users}', 'UserController@show');

Route::group(['middleware' => ['jwt.verify']], function() {

//Route::get('appointments', 'AppointmentController@index');
//Route::get('specialties', 'SpecialtyController@index');

    Route::get('user', 'UserController@getAuthenticatedUser');


    //appointments

    Route::get('appointments/{appointments}', 'AppointmentController@show');
    Route::post('appointments', 'AppointmentController@store');
    Route::put('appointments/{appointments}', 'AppointmentController@update');


    //specialties

    Route::get('specialties/{specialties}', 'SpecialtyController@show');
    Route::post('specialties', 'SpecialtyController@store');
    Route::put('specialties/{specialties}', 'SpecialtyController@update');
    Route::delete('specialties/{specialties}', 'SpecialtyController@delete');

});
