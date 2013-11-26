<?php

use Illuminate\Database\Migrations\Migration;

class CreateDocumentAttachmentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('document_attachment', function($table) {
			$table->integer('document_id')->unsigned();
			$table->integer('attachment_id')->unsigned();
			$table->engine = 'InnoDB';
			$table->primary(array('document_id', 'attachment_id'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('document_attachment');
	}

}