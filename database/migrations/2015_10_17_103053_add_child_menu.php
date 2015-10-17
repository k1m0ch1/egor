<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddChildMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('child_menu', function (Blueprint $table) {
            $table->increments('id', 3);
            $table->integer('parent_id', 3);
            $table->string('name', 200);
            $table->text('redirect');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::drop('child_menu');
    }
}
