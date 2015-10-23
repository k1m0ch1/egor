<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Module;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $perm_1 = new Module;
        $perm_1->name = 'Home';
        $perm_1->route = 'index';
        $perm_1->save();

        $perm_2 = new Module;
        $perm_2->name = 'Login';
        $perm_2->route = 'login.get';
        $perm_2->save();

        $perm_3 = new Module;
        $perm_3->name = 'User';
        $perm_3->route = 'admin.user.get';
        $perm_3->save();

        $perm_4 = new Module;
        $perm_4->name = 'Role';
        $perm_4->route = 'admin.role.get';
        $perm_4->save();

        $perm_5 = new Module;
        $perm_5->name = 'Permission';
        $perm_5->route = 'admin.permission.get';
        $perm_5->save();

        $perm_6 = new Module;
        $perm_6->name = 'Module';
        $perm_6->route = 'admin.modules.get';
        $perm_6->save();

        $perm_7 = new Module;
        $perm_7->name = 'Dashboard';
        $perm_7->route = 'admin.dashboard.get';
        $perm_7->save();

        $perm_8 = new Module;
        $perm_8->name = 'Preference';
        $perm_8->route = 'admin.preference.get';
        $perm_8->save();

        $perm_9 = new Module;
        $perm_9->name = 'Image';
        $perm_9->route = 'admin.images.get';
        $perm_9->save();

        $modules = Module::all();

        foreach ($modules as $key => $m) {
        	$permission = new Permission;
        	$permission->name = $m->name;
        	$permission->display_name = 'Dapat mengakses module '.$m->name;
        	$permission->access = true;
        	$permission->action = 'access';
        	$permission->type = 'module';
        	$permission->save();
        }


    }
}
