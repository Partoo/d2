<?php

use Illuminate\Database\Migrations\Migration;

class CreateSecLevelTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
			Schema::create('seclevel', function($table) {
			$table->increments('id');
			$table->string('seclevel',100)->unique();
			$table->engine = 'InnoDB';
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('seclevel');
	}

}