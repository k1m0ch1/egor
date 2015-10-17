<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TabelChildFrontpage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('child_frontpage', function (Blueprint $table) {
            $table->increments('id', 3);
            $table->integer('parent_id', 3);
            $table->string('nama', 200);
            $table->text('redirect');
            $table->text('image');
            $table->enum('mode', ['_blank','_self'])->default('_blank');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('child_frontpage');
    }
}
