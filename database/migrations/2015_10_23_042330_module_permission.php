<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModulePermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permissions', function (Blueprint $table) {
          $table->string('access');
          $table->integer('action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permission_role', function (Blueprint $table) {
            $table->dropColumn('access');
            $table->dropColumn('action');
        });
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropColumn('access');
            $table->dropColumn('action');
        });
    }
}
