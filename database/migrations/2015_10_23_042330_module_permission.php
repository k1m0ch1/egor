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
        Schema::table('permission_role', function (Blueprint $table) {
            $table->enum('access', ['true','false'])->default('false');
            $table->enum('action', ['access', 'add', 'edit', 'delete'])->default('access');
        });
        Schema::table('permissions', function (Blueprint $table) {
          $table->enum('access', ['module','app'])->default('module');
          $table->enum('action', ['access', 'add', 'edit', 'delete'])->default('access');
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
