<?php

class CategoryTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('category')->truncate();
        $lists = array('命令','议案','决定','公告','通告','通知','通报','报告','请示','批复','意见','函','会议纪要');

        foreach ($lists as $key => $val) {
            $category[$key] = array(
            'category' =>$lists[$key]
            );
     }


		// Uncomment the below to run the seeder
     DB::table('categories')->insert($category);
 }

}
