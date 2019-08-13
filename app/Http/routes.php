<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => "cors"], function ()
{
    Route::get('/', ['uses' => 'UserController@index','as' => 'index']);
    Route::get('{id}/tasks', ['uses' => 'UserController@getUserTasks','as' => 'tasks']);
});

Route::group(['prefix' => 'task', 'as' => 'task.', 'middleware' => "cors"], function ()
{
    Route::get('/', ['uses' => 'TaskController@index','as' => 'index']);
    Route::post('{id}/upload', ['uses' => 'TaskController@uploadFile','as' => 'upload']);
    Route::get('{id}/edit', ['uses' => 'TaskController@edit','as' => 'edit'])->where('id', '[0-9]+');
    Route::match(['put','patch'],'{id}/edit', ['uses' => 'TaskController@update','as' => 'update'])->where('id', '[0-9]+');
    Route::get('{id}/users', ['uses' => 'TaskController@getTaskUsers','as' => 'users'])->where('id', '[0-9]+');
});

Route::get('/', ['uses' => 'UserController@index','as' => 'Index']);
