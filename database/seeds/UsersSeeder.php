<?php

use Illuminate\Database\Seeder;
use Fzaninotto\Faker;
use App\Models\Role;
use App\Models\User;
class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_1 = new User;
        $user_1->name = 'tech';
        $user_1->email = 'tech@ordent.co';
        $user_1->password = \Hash::make('tech1234');
        $user_1->phone = '082214250262';
        $user_1->department = 'Technical Administrator';
        $user_1->save();

        $user_2 = new User;
        $user_2->name = 'admin';
        $user_2->email = 'admin@ordent.co';
        $user_2->password = \Hash::make('admin1234');
        $user_2->phone = '082214250262';
        $user_2->department = 'Management Administrator';
        $user_2->save();

        $role_1 = new Role;
        $role_1->name = 'tech';
        $role_1->display_name = 'tech';
        $role_1->description = 'Technical Administration';
        $role_1->save();

        $role_2 = new Role;
        $role_2->name = 'admin';
        $role_2->display_name = 'admin';
        $role_2->description = 'Management Administration';
        $role_2->save();

        $user_1->attachRole($role_1);
        $user_2->attachRole($role_2);
    }
}
