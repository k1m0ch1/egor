<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
    $permissions = new Permission;
		$permissions->name = 'can-access';
		$permissions->display_name = "Dapat Mengakses";
    $permissions->description = "Fungsi Permission";
    $permissions->access = "true";
    $permissions->action = "access";
		$permissions->save();
    $permissions = new Permission;
		$permissions->name = 'can-add';
		$permissions->display_name = "Dapat Menambah";
    $permissions->description = "Fungsi Permission";
    $permissions->access = "true";
    $permissions->action = "add";
		$permissions->save();
    $permissions = new Permission;
		$permissions->name = 'can-edit';
		$permissions->display_name = "Dapat Mengubah";
    $permissions->description = "Fungsi Permission";
    $permissions->access = "true";
    $permissions->action = "edit";
		$permissions->save();
    $permissions = new Permission;
		$permissions->name = 'can-delete';
		$permissions->display_name = "Dapat Menghapus";
    $permissions->description = "Fungsi Permission";
    $permissions->access = "true";
    $permissions->action = "delete";
		$permissions->save();
	}
}
