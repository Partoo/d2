<?php

use Illuminate\Database\Migrations\Migration;

class CreateDocflowsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('docflows', function($table) {
		$table->increments('event_id');
	            $table->string('event');//记录事件
	            $table->integer('document_id');
	            $table->tinyInteger('type')->unsigned()->default(0);//事件类型
		$table->text('comments');//用户的各种留言（发送者/接收者/审判者）
	            $table->timestamps();
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
		Schema::drop('docflows');
	}

}