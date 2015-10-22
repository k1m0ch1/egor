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
Route::get('logout', function(){
	Auth::logout();
	return redirect('/');
});

Route::get('admin/user', ['uses'=>'PagesController@user', 'as'=>'admin.user.get', 'middleware'=>'auth']);
Route::get('admin/role', ['uses'=>'PagesController@role', 'as'=>'admin.role.get', 'middleware'=>'auth']);
Route::get('admin/permission', ['uses'=>'PagesController@permission', 'as'=>'admin.permission.get', 'middleware'=>'auth']);
Route::get('admin/module', ['uses'=>'PagesController@module', 'as'=>'admin.permission.get', 'middleware'=>'auth']);

Route::get('admin/tes', ['uses'=>'PagesController@tes', 'as'=>'admin.user.get', 'middleware'=>'auth']);
Route::get('admin/dashboard', ['uses'=>'PagesController@dashboard', 'as'=>'admin.dashboard.get', 'middleware'=>'auth']);
Route::get('admin/menu', ['uses'=>'PagesController@menu', 'as'=>'admin.menu.get', 'middleware'=>'auth']);
Route::get('admin/preference', ['uses'=>'PagesController@preference', 'as'=>'admin.preference.get', 'middleware'=>'auth']);
Route::get('admin/grid', ['uses'=>'PagesController@grid', 'as'=>'admin.grid.get', 'middleware'=>'auth']);

Route::post('admin/filesList/{id}', ['uses'=>'PagesController@fileList', 'as'=>'admin.grid.get', 'middleware'=>'auth']);

Route::get('admin/setGrid', ['uses'=>'PagesController@setGrid', 'as'=>'admin.grid.set', 'middleware'=>'auth']);

Route::get('admin/form:child', ['uses'=>'ChildController@formChild', 'as'=>'admin.grid.get', 'middleware'=>'auth']);
Route::get('admin/form:child[add]', ['uses'=>'ChildController@addNewChild', 'middleware'=>'auth']);
Route::post('admin/form:child[add:save]', ['uses'=>'ChildController@saveNewChild', 'middleware'=>'auth']);
Route::get('admin/form:child[edit]', ['uses'=>'ChildController@editSave', 'middleware'=>'auth']);
Route::get('admin/form:child[delete]', ['uses'=>'ChildController@delete', 'middleware'=>'auth']);
Route::get('admin/form:dashboard', ['uses'=>'DashboardController@formDashboard', 'as'=>'admin.grid.post', 'middleware'=>'auth']);

Route::post('admin/grid:savePosition', ['uses'=>'GridController@savePosition', 'as'=>'admin.grid.post', 'middleware'=>'auth']);

Route::post('admin/dashboard[edit:save]', ['uses'=>'DashboardController@editSave', 'as'=>'dashboard[edit:save]', 'middleware'=>'auth']);
Route::get('admin/dashboard[delete]', ['uses'=>'DashboardController@delete', 'as'=>'dashboard[edit:save]', 'middleware'=>'auth']);
Route::get('admin/dashboard[show:app]', ['uses'=>'DashboardController@showApp', 'as'=>'dashboard[edit:save]', 'middleware'=>'auth']);

Route::post('admin/gambar[upload]', ['uses'=>'GambarController@upload', 'as'=>'gambar[upload]', 'middleware'=>'auth']);
Route::post('admin/gambar[Bg:upload]', ['uses'=>'GambarController@bgUpload', 'as'=>'gambar[Bg:upload]', 'middleware'=>'auth']);
Route::post('admin/gambar[Logo:upload]', ['uses'=>'GambarController@logoUpload', 'as'=>'gambar[Logo:upload]', 'middleware'=>'auth']);
Route::post('admin/gambar[Logo:save]', ['uses'=>'GambarController@logoSave', 'as'=>'gambar[Logo:upload]', 'middleware'=>'auth']);
Route::post('admin/gambar[Bg:save]', ['uses'=>'GambarController@BgSave', 'as'=>'gambar[Logo:upload]', 'middleware'=>'auth']);
Route::post('admin/gambar[BG:upload]', ['uses'=>'GambarController@BgUpload', 'as'=>'gambar[Logo:upload]', 'middleware'=>'auth']);
Route::get('admin/gambar', ['uses'=>'PagesController@indexGambar', 'as'=>'gambar[index]', 'middleware'=>'auth']);

Route::post('admin/users[edit:save]', ['uses'=>'UsersController@save', 'as'=>'users[edit:save]', 'middleware'=>'auth']);
Route::get('admin/users[edit:show]', ['uses'=>'UsersController@show', 'as'=>'users[edit:show]', 'middleware'=>'auth']);
Route::get('admin/users[show]', ['uses'=>'UsersController@showAll', 'as'=>'users[edit:show]', 'middleware'=>'auth']);
Route::get('admin/users[add:show]', ['uses'=>'UsersController@show', 'as'=>'users[edit:show]', 'middleware'=>'auth']);
Route::get('admin/users[delete]', ['uses'=>'UsersController@delete', 'as'=>'users[edit:show]', 'middleware'=>'auth']);

Route::get('admin/roles[edit:show]', ['uses'=>'RoleController@form', 'as'=>'roles[edit:show]', 'middleware'=>'auth']);
Route::post('admin/roles[edit:save]', ['uses'=>'RoleController@save', 'as'=>'roles[edit:show]', 'middleware'=>'auth']);
Route::get('admin/roles[show]', ['uses'=>'RoleController@show', 'as'=>'roles[edit:show]', 'middleware'=>'auth']);
Route::get('admin/roles[add:show]', ['uses'=>'RoleController@form', 'as'=>'roles[edit:show]', 'middleware'=>'auth']);
Route::get('admin/roles[del]', ['uses'=>'RoleController@del', 'as'=>'roles[edit:show]', 'middleware'=>'auth']);
Route::get('admin/roles[permission:show]', ['uses'=>'RoleController@showPermission', 'as'=>'roles[edit:show]', 'middleware'=>'auth']);
Route::post('admin/roles[set:permission]', ['uses'=>'RoleController@setPermission', 'as'=>'permission[edit:show]', 'middleware'=>'auth']);
Route::get('admin/roles[permission:delete]', ['uses'=>'RoleController@delSetPermission', 'as'=>'roles[edit:show]', 'middleware'=>'auth']);

Route::get('admin/permission[edit:show]', ['uses'=>'PermissionController@form', 'as'=>'permission[edit:show]', 'middleware'=>'auth']);
Route::post('admin/permission[edit:save]', ['uses'=>'PermissionController@save', 'as'=>'permission[edit:show]', 'middleware'=>'auth']);
Route::get('admin/permission[show]', ['uses'=>'PermissionController@show', 'as'=>'permission[edit:show]', 'middleware'=>'auth']);
Route::get('admin/permission[show2]', ['uses'=>'PermissionController@showPermission', 'as'=>'permission[edit:show]', 'middleware'=>'auth']);
Route::get('admin/permission[add:show]', ['uses'=>'PermissionController@form', 'as'=>'permission[edit:show]', 'middleware'=>'auth']);
Route::get('admin/permission[del]', ['uses'=>'PermissionController@del', 'as'=>'permission[edit:show]', 'middleware'=>'auth']);

Route::get('admin/module[edit:show]', ['uses'=>'ModuleController@form', 'as'=>'permission[edit:show]', 'middleware'=>'auth']);
Route::post('admin/module[edit:save]', ['uses'=>'ModuleController@save', 'as'=>'permission[edit:show]', 'middleware'=>'auth']);
Route::get('admin/module[show]', ['uses'=>'ModuleController@show', 'as'=>'permission[edit:show]', 'middleware'=>'auth']);
Route::get('admin/module[show2]', ['uses'=>'ModuleController@showModules', 'as'=>'permission[edit:show]', 'middleware'=>'auth']);
Route::get('admin/module[add:show]', ['uses'=>'ModuleController@form', 'as'=>'permission[edit:show]', 'middleware'=>'auth']);
Route::get('admin/module[del]', ['uses'=>'ModuleController@del', 'as'=>'permission[edit:show]', 'middleware'=>'auth']);

Route::post('admin/menu[edit:save]', ['uses'=>'MenusController@editSave', 'middleware'=>'auth']);
Route::get('admin/menu[select]', ['uses'=>'MenusController@select2', 'middleware'=>'auth']);
Route::get('admin/menu[del]', ['uses'=>'MenusController@delParent', 'middleware'=>'auth']);
Route::post('admin/menu[add:save]', ['uses'=>'MenusController@addSave', 'middleware'=>'auth']);
Route::get('admin/menu:child', ['uses'=>'MenusController@getChild', 'middleware'=>'auth']);
Route::get('admin/menu:child[add]', ['uses'=>'MenusController@newChild', 'middleware'=>'auth']);
Route::post('admin/menu:child[add:save]', ['uses'=>'MenusController@saveNewChild', 'middleware'=>'auth']);
Route::get('admin/menu:child[del]', ['uses'=>'MenusController@delChild', 'middleware'=>'auth']);
Route::get('admin/menu:child[edit]', ['uses'=>'MenusController@editChild', 'middleware'=>'auth']);

Route::post('admin/preference:title[save]', ['uses'=>'PreferenceController@preferenceSave', 'as'=>'title.preference.get', 'middleware'=>'auth']);
Route::post('admin/preference:image', ['uses'=>'PreferenceController@image', 'as'=>'image.preference.get', 'middleware'=>'auth']);
Route::post('admin/preference:background[save]', ['uses'=>'PreferenceController@preferenceSave', 'as'=>'background.preference.get', 'middleware'=>'auth']);
Route::post('admin/preference:logo[save]', ['uses'=>'PreferenceController@preferenceSave', 'as'=>'logo.preference.get', 'middleware'=>'auth']);
Route::post('admin/preference:footer[save]', ['uses'=>'PreferenceController@preferenceSave', 'as'=>'title.preference.get', 'middleware'=>'auth']);

Route::group(['prefix'=>'/api/v1'], function(){
	Route::get('/menu/list', ['uses'=>'MenusController@index', 'as'=>'menus.list.get']);
	Route::get('/setting/list', 'SettingsController@index');
	Route::get('/grid/size', ['uses'=>'GridController@getGridSize']);
	Route::get('/path/uploads/{id}', ['uses'=>'GambarController@uploadPath']);
});
