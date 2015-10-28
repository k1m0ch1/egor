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
      $column = Array();
      $nameColumn = Array('nama', 'position', 'redirect', 'image', 'mode', 'publicKey', 'privateKey');

      if (!Schema::hasTable('parent_frontpage')) {
        Schema::create('parent_frontpage', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('position');
            $table->string('image');
            $table->string('redirect');
            $table->enum('mode', ['_blank', '_self'])->default('_blank');
            $table->string('privateKey');
            $table->string('publicKey');
            $table->timestamps();

        });
      }else{
        for($a=0;$a<count($nameColumn);$a++){
          $column[$a] = Schema::hasColumn('parent_frontpage', $nameColumn[$a])?true:false;
          if($column[$a]){
            Schema::tables('parent_frontpage', function($tables){
              if($nameColumn[$a]=="mode"){
                $table->enum('mode', ['_blank', '_self'])->default('_blank');
              }else{
                $tables->string($nameColumn[$a]);
              }
            });
          }
        }
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
