<?php

use App\Pacients;
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
Route::get('pacients', function(){
    return Pacients::all();
});

Route::get('pacients/{id}', function($id){
    return Pacients::find($id);
});

Route::post('pacients', function(Request $request){
    return Pacients::create($request->all());
});

Route::put('pacients/{id}', function(Request $request, $id){
    $pacients = Pacients::findOrFail($id);
    $pacients->update($request->all());
    return$pacients;
});

Route::delete('pacients/{id}', function($id){
    Pacients::find($id)->delete();
    return 204;
});
