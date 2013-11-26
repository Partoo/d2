<?php

use Illuminate\Database\Migrations\Migration;

class CreateDocumentTagTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('document_tag', function($table)
		{
			$table->increments('id');
			$table->integer('document_id')->unsigned();
			$table->integer('tag_id')->unsigned();

			// We'll need to ensure that MySQL uses the InnoDB engine to
			// support the indexes, other engines aren't affected.
			$table->engine = 'InnoDB';
			$table->index('document_id');
			$table->index('tag_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('document_tag');
	}

}