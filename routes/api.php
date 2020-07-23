<?php

use Illuminate\Http\Request;
use App\Quote;

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

Route::group(['middleware' => ['jwt.verify']], function(){


    Route::get('quotes', function(){
        return Quote::all();});
    Route::get('quotes/{id}', function($id){
        return Quote::find($id);});
    Route::post('quotes', function(Request $request){
        return Quote::create($request->all());});
    Route::put('quotes/{id}', function(Request $request, $id){$quote = Quote::findOrFail($id);$quote->update($request->all());
    return $quote;});
    Route::delete('quotes/{id}', function($id){Quote::find($id)->delete();
    return204;});




});
