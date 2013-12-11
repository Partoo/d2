<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDocumentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('documents', function(Blueprint $table) {
			$table->increments('id');
			$table->string('subject',100);//公文名称
			$table->string('docnumber',45);//公文编号
			$table->string('seclevel',15);//密级
			$table->string('priority',15);//紧急程度
			$table->integer('category')->unsigned();//分类
			$table->integer('sender_id')->unsigned();//发送者
			$table->text('creDep');//创建单位 逗号分隔
			$table->text('helpDep');//协办单位 逗号分隔
			$table->text('leader'); //领导 逗号分隔
			$table->text('mainSend');//主送 逗号分隔用户id，形如：1,2,3
			$table->text('copySend');//抄送 逗号分隔用户id，形如：1,2,3
			$table->tinyInteger('state')->default(0);//公文状态 -1:拟办 0:待审批 1:审批通过 2:审批退回 3:已签发 4:已办结 5:已归档
			$table->tinyInteger('createType')->unsigned()->default(0);//发文类型 0:普通发文 1:联合发文
			// $table->integer('event_id')->unsigned();//文档事件表
			$table->text('content'); //内容提要
			$table->string('filePath');//公文url
			$table->string('attachment');//附件url
			$table->timestamps();
			$table->softDeletes();

			$table->engine = 'InnoDB';
			$table->index('subject');
			$table->index('filePath');
			$table->index('category');
			$table->index('sender_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('documents');
	}

}
