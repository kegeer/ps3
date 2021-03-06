<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', 'AdminController@index');

    Route::get('batches', ['uses' => 'BatchController@index', 'as' => 'batches.index']);
    Route::get('/batches/{id}/samples', ['uses' => 'BatchController@samples', 'as' => 'batch.samples']);

    Route::get('projects', ['uses' => 'ProjectController@index', 'as' => 'projects.index']);
    Route::get('/projects/{id}/tasks', ['uses' => 'ProjectController@tasks', 'as' => 'project.tasks']);

    Route::get('/roadmaps', ['uses' => 'RoadmapController@index', 'as' => 'roadmaps.index']);

    Route::get('/procedures', ['uses' => 'ProcedureController@index', 'as' => 'procedures.index']);
    Route::get('/reports', ['uses' => 'ReportController@index', 'as' => 'reports.index']);

    Route::get('/results', ['uses' => 'ResultController@index', 'as' => 'results.index']);

});
