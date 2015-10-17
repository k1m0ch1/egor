<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPreference extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('preference', function (Blueprint $table) {
            $table->increments('id', 1);
            $table->string('title', 200);
            $table->text('logo');
            $table->text('footer');
            $table->string('grid');
            $table->text('background');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('preference');
    }
}
