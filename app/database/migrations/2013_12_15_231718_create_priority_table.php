<?php

use Illuminate\Database\Migrations\Migration;

class CreatePriorityTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('priority', function($table) {
			$table->increments('id');
			$table->string('priority',100)->unique();
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
		Schema::drop('priority');
	}

}