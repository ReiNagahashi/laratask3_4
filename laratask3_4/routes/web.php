<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/',[
    'uses' => 'TaskController@index',
    'as' => 'home'
]);

Route::post('/create',[
    'uses' => 'TaskController@create',
    'as' => 'task.create'
]);

Route::post('/updateCompleted',[
    'uses' => 'TaskController@completedUpdate',
    'as' => 'updateCompleted'
]);