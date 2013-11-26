<?php

class DocumentsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('documents')->truncate();

		$documents = array(

            'subject' =>'这是一篇新的稿子',
            'tags_id' => '工程,计生',
            'docnumber' =>'胶政办发〔2013〕28号 ',
            'seclevel' =>1,
            'priority' => 0,
            'category' => '通知',
            'sender_id' => 1,
            'creDep'=>'市委办公室',
            'mainSend'=>'1,3',
            'state' =>0,
            'event_id'=>1,
            'filePath'=>'/mypath'

            );

		// Uncomment the below to run the seeder
		DB::table('documents')->insert($documents);
	}

}
