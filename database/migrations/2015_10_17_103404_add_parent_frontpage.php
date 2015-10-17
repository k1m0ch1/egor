<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddParentFrontpage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parent_frontpage', function (Blueprint $table) {
            $table->increments('id', 3);
            $table->string('nama', 100);
            $table->integer('position', 2);
            $table->text('redirect');
            $table->text('image');
            $table->enum('mode', ['_blank','_self'])->('_blank');
        });
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
