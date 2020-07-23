<?php

use App\Quote;
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
Route::get('quotes', 'QuotesController@index');
Route::get('quotes/{quotes}', 'QuotesController@show');
Route::post('quotes', 'QuotesController@store');
Route::put('quotes/{quotes}', 'QuotesController@update');
Route::delete('quotes/{quotes}', 'QuotesController@delete');

Route::get('pacients', 'PacientsController@index');
Route::get('pacients/{pacients}', 'PacientsController@show');
Route::post('pacients', 'PacientsController@store');
Route::put('pacients/{pacients}', 'PacientsController@update');
Route::delete('pacients/{pacients}', 'PacientsController@delete');

Route::get('doctors', 'DoctorController@index');
Route::get('doctors/{doctors}', 'DoctorController@show');
Route::post('doctors', 'DoctorController@store');
Route::put('doctors/{doctors}', 'DoctorController@update');
Route::delete('doctors/{doctors}', 'DoctorController@delete');
