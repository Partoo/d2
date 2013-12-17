<?php

class SentrySeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('documents')->truncate();

        // DB::table('users')->delete();
        // DB::table('groups')->delete();
        // DB::table('units')->delete();
        // DB::table('users_groups')->delete();
        // DB::table('users_units')->delete();

        Sentry::getUserProvider()->create(
            array(
                'email'       => 'mail@istarLand.com',
                'password'    => "admin888",
                'username'  => '管理员',
                'phone'   => '18669783161',
                'activated'   => 1,
                ));

        Sentry::getUserProvider()->create(
            array(
                'email'       => 'iris@163.com',
                'password'    => "jiaoxi",
                'username'  => '周洁',
                'phone'   => '13791965566',
                'activated'   => 1,
                ));

        Sentry::getGroupProvider()->create(
            array(
                'name'        => '管理员',
                'permissions' => array('admin' => 1,'viewer'=>1),
                ));

        Sentry::getGroupProvider()->create(
            array(
                'name'        => '领导班子',
                'permissions' => array('leader'=>1,'viewer'=>1),
                ));

        Sentry::getGroupProvider()->create(
            array(
                'name'        => '普通用户',
                'permissions' => array('admin' => 0),
                ));

        Sentry::getUnitProvider()->create(
            array(
                'name' =>'办公室',
                ));

        Sentry::getUnitProvider()->create(
            array(
                'name' =>'组织部',
                ));

                        // Assign user permissions
        $adminUser  = Sentry::getUserProvider()->findByLogin('mail@istarLand.com');
        $adminGroup = Sentry::getGroupProvider()->findByName('管理员');
        $adminUnit = Sentry::getUnitProvider()->findByName('办公室');
        $adminUser->addGroup($adminGroup);
        $adminUser->addUnit($adminUnit);

        $adminUser2  = Sentry::getUserProvider()->findByLogin('iris@163.com');
        $adminGroup2 = Sentry::getGroupProvider()->findByName('管理员');
        $adminUnit2 = Sentry::getUnitProvider()->findByName('办公室');
        $adminUser2->addGroup($adminGroup2);
        $adminUser2->addUnit($adminUnit2);



		// Uncomment the below to run the seeder
		// DB::table('documents')->insert($documents);
    }

}
