<?php

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
});*/

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::post('show', 'API\UserController@show');
Route::post('update', 'API\UserController@update');
Route::post('delete', 'API\UserController@destroy');

Route::post('vendors', 'API\VendorController@index');
Route::post('vendor/create', 'API\VendorController@store');
Route::post('vendor/single/{id}', 'API\VendorController@show');
Route::post('vendor/update/{id}', 'API\VendorController@update');
Route::post('vendor/delete/{id}', 'API\VendorController@destroy');

Route::post('assigns', 'API\AssetAssignmentController@index');
Route::post('assign/create', 'API\AssetAssignmentController@store');
Route::post('assign/single/{id}', 'API\AssetAssignmentController@show');
Route::post('assign/update/{id}', 'API\AssetAssignmentController@update');
Route::post('assign/delete/{id}', 'API\AssetAssignmentController@destroy');

Route::middleware('jwt.auth')->group(function(){
    
    Route::post('logout', 'API\UserController@logout');

});