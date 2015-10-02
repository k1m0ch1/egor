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

Route::get('/', 'PagesController@index');

Route::get('login', ['uses'=>'UsersController@login', 'as'=>'users.login.get']);
Route::post('login', ['uses'=>'UsersController@postLogin', 'as'=>'users.login.post']);

Route::get('admin/dashboard', ['uses'=>'PagesController@dashboard', 'as'=>'admin.dashboard.get', 'middleware'=>'auth']);

Route::group(['prefix'=>'api/v1'], function(){
	Route::get('/menu/list', ['uses'=>'MenusController@index', 'as'=>'menus.list.get']);
	Route::get('/setting/list', 'SettingsController@index');

});