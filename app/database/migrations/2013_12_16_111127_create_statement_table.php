<?php

use Illuminate\Database\Migrations\Migration;

class CreateStatementTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
			Schema::create('statements', function($table) {
			$table->increments('id');
			$table->string('statement',100)->unique();
			$table->tinyInteger('type')->unsigned()->default(0);//0为普通用户用用语，1为领导
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
		Schema::drop('statements');
	}

}