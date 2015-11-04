<?php

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$result_1 = new Setting;
    	$result_1->name = 'grid_width';
    	$result_1->value = 3;
    	$result_1->save();

    	$result_2 = new Setting;
    	$result_2->name = 'grid_height';
    	$result_2->value = 3;
    	$result_2->save();

    	$result_3 = new Setting;
    	$result_3->name = 'background';
    	$result_3->value = 'assets/img/bg.jpg';
    	$result_3->save();

    	$result_4 = new Setting;
    	$result_4->name = 'logo';
    	$result_4->value = '';
    	$result_4->save();

    	$result_5 = new Setting;
    	$result_5->name = 'title';
    	$result_5->value = 'Website.com';
    	$result_5->save();

    	$result_6 = new Setting;
    	$result_6->name = 'footer';
    	$result_6->value = '(C) 2015 All Right Reserved';
    	$result_6->save();
    }
}
