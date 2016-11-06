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

Route::get('/', function () {
    return view('welcome');
});

Route::get('batches', ['uses' => 'BatchController@index', 'as' => 'batches.index']);
Route::get('/batches/{id}/samples', ['uses' => 'BatchController@samples', 'as' => 'batch.samples']);

Route::get('projects', ['uses' => 'ProjectController@index', 'as' => 'projects.index']);
Route::get('/projects/{id}/tasks', ['uses' => 'ProjectController@tasks', 'as' => 'projects.tasks']);
