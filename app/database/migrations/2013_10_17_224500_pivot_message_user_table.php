<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class PivotMessageUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('message_user', function(Blueprint $table) {
			$table->increments('id');
			$table->tinyInteger('status')->default(0);//0:未读 1:已读 3:删除
			$table->integer('message_id')->unsigned()->index();//消息编号
			$table->integer('sender_id')->unsigned()->index();//发送者编号
			$table->integer('reciever_id')->unsigned()->index()->default(0);//接受者编号 0:所有人
		});
	}



	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('message_user');
	}

}
