<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Module;
use App\Models\Role;

class ModuleSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$module = new Module;
		$module->name = 'Home Site';
		$module->route = "/";
		$module->save();
		$module = new Module;
		$module->name = 'Login';
		$module->route = "login";
		$module->save();
		$module = new Module;
		$module->name = 'Backend User';
		$module->route = "admin/user";
		$module->save();
		$module = new Module;
		$module->name = 'Backend Role';
		$module->route = "admin/role";
		$module->save();
		$module = new Module;
		$module->name = 'Backend Permission';
		$module->route = "admin/permission";
		$module->save();
		$module = new Module;
		$module->name = 'Backend Module';
		$module->route = "admin/module";
		$module->save();
		$module = new Module;
		$module->name = 'Backend Dashboard';
		$module->route = "admin/dashboard";
		$module->save();
		$module = new Module;
		$module->name = 'Backend Menu';
		$module->route = "admin/menu";
		$module->save();
		$module = new Module;
		$module->name = 'Backend Preference';
		$module->route = "admin/preference";
		$module->save();
		$module = new Module;
		$module->name = 'Backend Grid';
		$module->route = "admin/grid";
		$module->save();
		$module = new Module;
		$module->name = 'Backend Gambar';
		$module->route = "admin/gambar";
		$module->save();
		$module = new Module;
		$module->name = 'Backend Menu Child';
		$module->route = "admin/menu:child";
		$module->save();
		$module = new Module;
		$module->name = 'Backend Preference Image';
		$module->route = "admin/preference:image";
		$module->save();
		$module = new Module;
		$module->name = 'Backend Preference Background';
		$module->route = "admin/preference:background";
		$module->save();
		$module = new Module;
		$module->name = 'Backend Preference Logo';
		$module->route = "admin/preference:logo";
		$module->save();
		$module = new Module;
		$module->name = 'Backend Preference Footer';
		$module->route = "admin/preference:footer";
		$module->save();

		$modules = Module::all();
		$admin = Role::where('name', 'admin')->get()->first();
		$tech = Role::where('name', 'tech')->get()->first();

		foreach ($modules as $key => $m) {
			$permission = new Permission;
			$permission->name = "can-access-module-" . $m->name;
			$permission->display_name = 'Dapat mengakses ' . $m->name;
			$permission->access = 'access';
			$permission->action = $m->id;
			$permission->type = 'module';
			$permission->save();

			$result = DB::table('permission_role')->insert([
              'role_id' => $admin->id,
              'permission_id' => $permission->id
          ]);

			$result = DB::table('permission_role')->insert([
              'role_id' => $tech->id,
              'permission_id' => $permission->id
          ]);
		}

	}
}
