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
                'email'       => '13963938366@istar.oa',
                'password'    => "jiaoxi",
                'username'  => '法勇',
                'phone'   => '13963938366',
                'activated'   => 1,
                ));

        Sentry::getUserProvider()->create(
            array(
                'email'       => '13791965566@istar.oa',
                'password'    => "jiaoxi",
                'username'  => '周洁',
                'phone'   => '13791965566',
                'activated'   => 1,
                ));

        Sentry::getUserProvider()->create(
            array(
                'email'       => '15192791616@istar.oa',
                'password'    => "jiaoxi",
                'username'  => '赵鹏',
                'phone'   => '15192791616',
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
        $adminUser  = Sentry::getUserProvider()->findByLogin('13791965566@istar.oa');
        $adminGroup = Sentry::getGroupProvider()->findByName('管理员');
        $adminUnit = Sentry::getUnitProvider()->findByName('办公室');
        $adminUser->addGroup($adminGroup);
        $adminUser->addUnit($adminUnit);

        $adminUser2  = Sentry::getUserProvider()->findByLogin('13791965566@istar.oa');
        $adminGroup2 = Sentry::getGroupProvider()->findByName('管理员');
        $adminUnit2 = Sentry::getUnitProvider()->findByName('办公室');
        $adminUser2->addGroup($adminGroup2);
        $adminUser2->addUnit($adminUnit2);

        $adminUser3  = Sentry::getUserProvider()->findByLogin('15192791616@istar.oa');
        $adminGroup3 = Sentry::getGroupProvider()->findByName('管理员');
        $adminUnit3 = Sentry::getUnitProvider()->findByName('办公室');
        $adminUser3->addGroup($adminGroup3);
        $adminUser3->addUnit($adminUnit3);



		// Uncomment the below to run the seeder
		// DB::table('documents')->insert($documents);
    }

}
