<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterParentFrontpage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parent_frontpage', function (Blueprint $table) {
            $table->text('query');
            $table->text('public_key');
            $table->text('private_key');
            $table->text('db_host');
            $table->text('db_user');
            $table->text('db_pass');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('parent_frontpage', function (Blueprint $table) {
            $table->dropColumn('query');
            $table->dropColumn('public_key');
            $table->dropColumn('private_key');
            $table->dropColumn('db_host');
            $table->dropColumn('db_user');
            $table->dropColumn('db_pass');
        });
    }
}
