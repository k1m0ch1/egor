<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateParentFrontpageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('parent_frontpage', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nama');
			$table->integer('position');
			$table->string('redirect');
			$table->string('image');
			$table->string('mode');
			$table->timestamps();
			$table->text('query', 65535);
			$table->text('public_key', 65535);
			$table->text('private_key', 65535);
			$table->text('db_host', 65535);
			$table->text('db_user', 65535);
			$table->text('db_pass', 65535);
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
