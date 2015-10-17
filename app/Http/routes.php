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

Route::get('admin/user', ['uses'=>'PagesController@user', 'as'=>'admin.user.get', 'middleware'=>'auth']);
Route::get('admin/tes', ['uses'=>'PagesController@tes', 'as'=>'admin.user.get', 'middleware'=>'auth']);
Route::get('admin/dashboard', ['uses'=>'PagesController@dashboard', 'as'=>'admin.dashboard.get', 'middleware'=>'auth']);
Route::get('admin/menu', ['uses'=>'PagesController@menu', 'as'=>'admin.menu.get', 'middleware'=>'auth']);
Route::get('admin/preference', ['uses'=>'PagesController@preference', 'as'=>'admin.preference.get', 'middleware'=>'auth']);
Route::get('admin/grid', ['uses'=>'PagesController@grid', 'as'=>'admin.grid.get', 'middleware'=>'auth']);

Route::get('admin/form:child', ['uses'=>'ChildController@formChild', 'as'=>'admin.grid.get', 'middleware'=>'auth']);
Route::get('admin/form:child[add]', ['uses'=>'ChildController@addNewChild', 'middleware'=>'auth']);
Route::post('admin/form:child[add:save]', ['uses'=>'ChildController@saveNewChild', 'middleware'=>'auth']);
Route::get('admin/form:child[edit]', ['uses'=>'ChildController@editSave', 'middleware'=>'auth']);
Route::get('admin/form:child[delete]', ['uses'=>'ChildController@delete', 'middleware'=>'auth']);

Route::post('admin/grid:savePosition', ['uses'=>'GridController@savePosition', 'as'=>'admin.grid.post', 'middleware'=>'auth']);

Route::get('admin/form:dashboard', ['uses'=>'DashboardController@formDashboard', 'as'=>'admin.grid.post', 'middleware'=>'auth']);
Route::post('admin/dashboard[edit:save]', ['uses'=>'DashboardController@editSave', 'as'=>'dashboard[edit:save]', 'middleware'=>'auth']);
Route::get('admin/dashboard[delete]', ['uses'=>'DashboardController@delete', 'as'=>'dashboard[edit:save]', 'middleware'=>'auth']);

Route::post('admin/gambar[upload]', ['uses'=>'GambarController@upload', 'as'=>'gambar[upload]', 'middleware'=>'auth']);
Route::get('admin/gambar', ['uses'=>'PagesController@indexGambar', 'as'=>'gambar[index]', 'middleware'=>'auth']);

Route::post('admin/users[edit:save]', ['uses'=>'UsersController@editSave', 'as'=>'users[edit:save]', 'middleware'=>'auth']);
Route::get('admin/users[edit:show]', ['uses'=>'UsersController@show', 'as'=>'users[edit:show]', 'middleware'=>'auth']);

Route::post('admin/menu[edit:save]', ['uses'=>'MenusController@editSave', 'middleware'=>'auth']);
Route::get('admin/menu[select]', ['uses'=>'MenusController@select2', 'middleware'=>'auth']);

Route::post('admin/preference:title[save]', ['uses'=>'PreferenceController@titleSave', 'as'=>'title.preference.get', 'middleware'=>'auth']);
Route::post('admin/preference:image', ['uses'=>'PreferenceController@image', 'as'=>'image.preference.get', 'middleware'=>'auth']);
Route::post('admin/preference:background[save]', ['uses'=>'PreferenceController@backgroundSave', 'as'=>'background.preference.get', 'middleware'=>'auth']);
Route::post('admin/preference:logo[save]', ['uses'=>'PreferenceController@logoSave', 'as'=>'logo.preference.get', 'middleware'=>'auth']);

Route::group(['prefix'=>'api/v1'], function(){
	Route::get('/menu/list', ['uses'=>'MenusController@index', 'as'=>'menus.list.get']);
	Route::get('/setting/list', 'SettingsController@index');

});