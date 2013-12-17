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
                'email'       => 'partoo@163.com',
                'password'    => "partooa",
                'username'  => '黄涛',
                'phone'   => '18669783161',
                'activated'   => 1,
                ));

        Sentry::getUserProvider()->create(
            array(
                'email'       => 'iris@163.com',
                'password'    => "partooa",
                'username'  => '张拉拉',
                'phone'   => '15966902150',
                'activated'   => 1,
                ));

        Sentry::getUserProvider()->create(
            array(
                'email'       => 'ootrap@163.com',
                'password'    => "partooa",
                'username'  => '黄小桃',
                'phone'   => '18669783162',
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
        $adminUser  = Sentry::getUserProvider()->findByLogin('partoo@163.com');
        $adminGroup = Sentry::getGroupProvider()->findByName('管理员');
        $adminUnit = Sentry::getUnitProvider()->findByName('办公室');
        $adminUser->addGroup($adminGroup);
        $adminUser->addUnit($adminUnit);

        $adminUser2  = Sentry::getUserProvider()->findByLogin('iris@163.com');
        $adminGroup2 = Sentry::getGroupProvider()->findByName('领导班子');
        $adminUnit2 = Sentry::getUnitProvider()->findByName('组织部');
        $adminUser2->addGroup($adminGroup2);
        $adminUser2->addUnit($adminUnit2);

        $adminUser3  = Sentry::getUserProvider()->findByLogin('ootrap@163.com');
        $adminGroup3 = Sentry::getGroupProvider()->findByName('普通用户');
        $adminUnit3 = Sentry::getUnitProvider()->findByName('组织部');
        $adminUser3->addGroup($adminGroup3);
        $adminUser3->addUnit($adminUnit3);



		// Uncomment the below to run the seeder
		// DB::table('documents')->insert($documents);
    }

}
