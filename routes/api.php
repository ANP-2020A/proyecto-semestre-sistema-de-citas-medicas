<?php
use App\Quotes;
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
Route::get('quotes', function(){
    return Quotes::all();
});

Route::get('quotes/{id}', function($id){
    return Quotes::find($id);
});

Route::post('quotes', function(Request $request){
    return Quotes::create($request->all());
});

Route::put('quotes/{id}', function(Request $request, $id){
    $quotes = Quotes::findOrFail($id);
    $quotes->update($request->all());
    return $quotes;
});

Route::delete('quotes/{id}', function($id){
    Quotes::find($id)->delete();
    return 204;
});
