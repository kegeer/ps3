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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['namespace' => 'Api'], function() {
    Route::get('/batches', 'BatchController@index');
    Route::post('/batches', 'BatchController@store');
    Route::put('/batches/{id}', 'BatchController@update');
    Route::delete('/bacthes/{id}', 'BatchController@destroy');

    Route::get('/batches/{id}/samples', 'BatchController@samples');
    Route::post('/samples', 'SampleController@store');
    Route::put('/samples/{id}', 'SampleController@update');
    Route::delete('/samples/{id}', 'SampleController@destroy');

    Route::group(['prefix' => 'projects'], function() {
    	Route::get('/', 'ProjectController@index');
    	Route::post('/', 'ProjectController@store');
    	Route::put('/{id}', 'ProjectController@update');
    	Route::delete('/{id}', 'ProjectController@destroy');
    	Route::get('/{id}/tasks', 'ProjectController@tasks');
    });

    Route::group(['prefix' => 'tasks'], function() {
    	Route::get('/', 'TaskController@index');
    	Route::post('/', 'TaskController@store');
    	Route::put('/{id}', 'TaskController@update');
    	Route::delete('/{id}', 'TaskController@destroy');
    });
});
