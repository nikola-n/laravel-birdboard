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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('projects', 'ProjectsController');
    //Route::get('projects', 'ProjectsController@index')->name('projects.index');
    //Route::get('projects/create', 'ProjectsController@create')->name('projects.create');
    //Route::get('projects/{project}', 'ProjectsController@show')->name('project.show');
    //Route::get('projects/{project}/edit', 'ProjectsController@edit')->name('projects.edit');
    //Route::patch('projects/{project}', 'ProjectsController@update')->name('project.update');
    //Route::post('projects', 'ProjectsController@store')->name('projects.store');
    //Route::delete('projects/{project}', 'ProjectsController@destroy')->name('projects.destroy');

    Route::post('projects/{project}/tasks', 'ProjectTasksController@store')->name('project.task.store');
    Route::patch('/projects/{project}/tasks/{task}', 'ProjectTasksController@update')->name('project.task.update');

    Route::post('/projects/{project}/invitations', 'ProjectInvitationsController@store')->name('project.invitations.store');

    Route::get('/home', 'HomeController@index')->name('home');
});

Auth::routes();

