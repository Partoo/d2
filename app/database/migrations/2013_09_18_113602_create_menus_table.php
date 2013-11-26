<?php

use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
			Schema::create('menus', function($table) {
			$table->increments('id');
			$table->string('label',18);
			$table->string('link');
			$table->tinyinteger('parent')->unsigned()->default(0);
			$table->string('icon',40);
			$table->tinyinteger('sort')->unsigned()->default(0);
			$table->engine = 'InnoDB';
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('menus');
	}

}