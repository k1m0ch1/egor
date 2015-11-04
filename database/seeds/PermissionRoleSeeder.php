<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Module;
use App\Models\Role;

class PermissionRoleSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		$modules = Module::all();
		$admin = Role::where('name', 'admin')->get()->first();
		$tech = Role::where('name', 'tech')->get()->first();

    $result = DB::table('permission_role')->insert([
        'role_id'=> $admin->id,
        'permission_id' => 1,
        'action' => 34,
        'access' => 'module'
      ]);

      $result = DB::table('permission_role')->insert([
          'role_id'=> $tech->id,
          'permission_id' => 1,
          'action' => 34,
          'access' => 'module'
        ]);

        $result = DB::table('permission_role')->insert([
            'role_id'=> $admin->id,
            'permission_id' => 2,
            'action' => 34,
            'access' => 'module'
          ]);

			$result = DB::table('permission_role')->insert([
              'role_id' => $tech->id,
              'permission_id' => 2,
              'action' => 34,
              'access' => 'module'
          ]);

          $result = DB::table('permission_role')->insert([
              'role_id'=> $admin->id,
              'permission_id' => 3,
              'action' => 34,
              'access' => 'module'
            ]);

            $result = DB::table('permission_role')->insert([
                'role_id'=> $tech->id,
                'permission_id' => 3,
                'action' => 34,
                'access' => 'module'
              ]);

              $result = DB::table('permission_role')->insert([
                  'role_id'=> $admin->id,
                  'permission_id' => 4,
                  'action' => 34,
                  'access' => 'module'
                ]);

            $result = DB::table('permission_role')->insert([
                    'role_id' => $tech->id,
                    'permission_id' => 4,
                    'action' => 34,
                    'access' => 'module'
                ]);

	}
}
