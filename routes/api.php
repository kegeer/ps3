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

    Route::group(['prefix' => 'batches'], function() {
        Route::get('/', 'BatchController@index');
        Route::post('/', 'BatchController@store');
        Route::put('/{id}', 'BatchController@update');
        Route::delete('/{id}', 'BatchController@destroy');
        Route::get('/{id}/tasks', 'BatchController@tasks');
         Route::get('/{id}/samples', 'BatchController@samples');
    });
    Route::group(['prefix' => 'samples'], function() {
        Route::post('/', 'SampleController@store');
        Route::put('/{id}', 'SampleController@update');
        Route::delete('/{id}', 'SampleController@destroy');
    });



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

    Route::group(['prefix' => 'roadmaps'], function() {
        Route::get('/', 'RoadmapController@index');
        Route::post('/', 'RoadmapController@store');
        Route::put('/{id}', 'RoadmapController@update');
        Route::delete('/{id}', 'RoadmapController@destroy');
        Route::get('/{id}/tasks', 'RoadmapController@tasks');
    });

    Route::get('procedures', 'ProcedureController@index');
    Route::post('procedures', 'ProcedureController@store');
    Route::post('protocols', 'ProtocolController@store');

    Route::group(['prefix' => 'results'], function(){
        Route::get('/', 'ResultController@index');
        Route::post('/', 'ResultController@store');
    });
});
