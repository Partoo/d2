<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('messages', function(Blueprint $table) {
			$table->increments('id');
			$table->text('content'); //消息内容
			$table->tinyInteger('type')->default(0);//消息类型 0:系统 1:管理员 2:用户
			$table->integer('sender')->default(0);//消息发送者 默认0:系统
			$table->tinyInteger('isDeleted')->default(0);//发件人是否删除 默认0:未删除
			$table->timestamps();
			$table->softDeletes();
			$table->engine = 'InnoDB';
			$table->index('sender');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('messages');
	}

}