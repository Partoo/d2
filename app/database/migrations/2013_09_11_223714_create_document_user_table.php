<?php

use Illuminate\Database\Migrations\Migration;

class CreateDocumentUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('document_user', function($table)
		{
			$table->integer('user_id')->unsigned();
			$table->integer('document_id')->unsigned();
			$table->tinyInteger('state')->default(0); //0:未读 1:已批阅 2:已签收 3:办结
			$table->tinyInteger('type')->default(0); //0:收件箱 1:发件箱 2:审批箱
			$table->integer('sender_id')->unsigned(); //发送者
			$table->engine = 'InnoDB';
			$table->primary(array('user_id', 'document_id','type'));

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('document_user');
	}

}