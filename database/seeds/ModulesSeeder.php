<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Module;
use App\Models\Role;

class ModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $module = new Module;
		$module->name = 'Home';
		$module->route = "'/', 'PagesController@index'";
		$module->save();
		$module = new Module;
		$module->name = 'login';
		$module->route = "'login', ['uses'=>'UsersController@login', 'as'=>'users.login.get']";
		$module->save();
		$module = new Module;
		$module->name = 'admin/user';
		$module->route = "'admin/user', ['uses'=>'PagesController@user', 'as'=>'admin.user.get', 'middleware'=>'auth']";
		$module->save();
		$module = new Module;
		$module->name = 'admin/role';
		$module->route = "'admin/role', ['uses'=>'PagesController@role', 'as'=>'admin.role.get', 'middleware'=>'auth']";
		$module->save();
		$module = new Module;
		$module->name = 'admin/permission';
		$module->route = "'admin/permission', ['uses'=>'PagesController@permission', 'as'=>'admin.permission.get']";
		$module->save();
		$module = new Module;
		$module->name = 'admin/module';
		$module->route = "'admin/module', ['uses'=>'PagesController@module', 'as'=>'admin.permission.get', 'middleware'=>'auth']";
		$module->save();
		$module = new Module;
		$module->name = 'admin/tes';
		$module->route = "'admin/tes', ['uses'=>'PagesController@tes', 'as'=>'admin.user.get', 'middleware'=>'auth']";
		$module->save();
		$module = new Module;
		$module->name = 'admin/dashboard';
		$module->route = "'admin/dashboard', ['uses'=>'PagesController@dashboard', 'as'=>'admin.dashboard.get', 'middleware'=>'auth']";
		$module->save();
		$module = new Module;
		$module->name = 'admin/menu';
		$module->route = "'admin/menu', ['uses'=>'PagesController@menu', 'as'=>'admin.menu.get', 'middleware'=>'auth']";
		$module->save();
		$module = new Module;
		$module->name = 'admin/preference';
		$module->route = "'admin/preference', ['uses'=>'PagesController@preference', 'as'=>'admin.preference.get', 'middleware'=>'auth']";
		$module->save();
		$module = new Module;
		$module->name = 'admin/grid';
		$module->route = "'admin/grid', ['uses'=>'PagesController@grid', 'as'=>'admin.grid.get', 'middleware'=>'auth']";
		$module->save();
		$module = new Module;
		$module->name = 'admin/form:child';
		$module->route = "'admin/form:child', ['uses'=>'ChildController@formChild', 'as'=>'admin.grid.get', 'middleware'=>'auth']";
		$module->save();
		$module = new Module;
		$module->name = 'Menu Images';
		$module->route = "any admin/gambar";
		$module->save();
		$module = new Module;
		$module->name = 'admin/users';
		$module->route = "[Menu^=admin/users]";
		$module->save();
		$module = new Module;
		$module->name = 'admin/roles';
		$module->route = "[Menu^=admin/roles]";
		$module->save();
		$module = new Module;
		$module->name = 'admin/menu:child';
		$module->route = "admin/menu:child";
		$module->save();
		$module = new Module;
		$module->name = 'admin/preference:image';
		$module->route = "admin/preference:image";
		$module->save();
		$module = new Module;
		$module->name = 'admin/preference:background';
		$module->route = "admin/preference:background";
		$module->save();
		$module = new Module;
		$module->name = 'admin/preference:logo';
		$module->route = "admin/preference:logo";
		$module->save();
		$module = new Module;
		$module->name = 'admin/preference:footer';
		$module->route = "admin/preference:footer";
		$module->save();


		$modules = Module::all();
		$admin = Role::where('name', 'admin')->get()->first();
		$tech = Role::where('name', 'tech')->get()->first();

		foreach ($modules as $key => $m) {
			$permission = new Permission;
			$permission->name = $m->name;
			$permission->display_name = 'Dapat mengakses module '.$m->name;
			$permission->access = true;
			$permission->action = 'access';
			$permission->type = 'module';
			$permission->save();

			$result = DB::table('permission_role')->insert([
              'role_id' => $admin->id,
              'permission_id' => $permission->id,
              'action' => 1,
              'access' => 'module'
          ]);

			$result = DB::table('permission_role')->insert([
              'role_id' => $tech->id,
              'permission_id' => $permission->id,
              'action' => 1,
              'access' => 'module'
          ]);


		}
    }
}
