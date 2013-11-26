<?php

class MenusTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('menus')->truncate();

		$menus = array(
                            'label' => '系统首页',
                            'link' => '/',
                            'parent' => '0',
                            'icon' =>'dashboard',
                            'sort' => '0'

		);

		// Uncomment the below to run the seeder
		DB::table('menus')->insert($menus);
	}

}
