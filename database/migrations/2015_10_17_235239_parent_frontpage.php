<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ParentFrontpage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      if (!Schema::hasTable('parent_frontpage')) {
        Schema::create('parent_frontpage', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->integer('position');
            $table->string('redirect');
            $table->string('image');
            $table->string('mode');
            $table->timestamps();

        });
      }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::drop('parent_frontpage');
    }
}
