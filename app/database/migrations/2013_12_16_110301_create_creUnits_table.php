<?php

use Illuminate\Database\Migrations\Migration;

class CreateCreUnitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
			Schema::create('creunits', function($table) {
			$table->increments('id');
			$table->string('unit',100)->unique();
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
		Schema::drop('creunits');
	}

}