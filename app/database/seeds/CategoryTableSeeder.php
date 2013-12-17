<?php

class CategoryTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('category')->truncate();
        $lists = array('命令','议案','决定','公告','通告','通知','通报','报告','请示','批复','意见','函','会议纪要');
        $dangers = array('普通','紧急','特急');
        $seclevels = array('普通','绝密','机密','秘密');
        $creDept = array('市委宣传部','市委组织部');
        $bb= array(
                            '有新的公文请您批示',
                            '有新的公文送达,请签收',
                            '请仔细阅读,认真把握该文件精神',
                            '请认真办理'
                    );
        $bb2 = array('尽快办理','积极配合');
        $action = array('请','责令','恳请');

        foreach ($lists as $key => $val) {
            $category[$key] = array(
                'category' =>$lists[$key]
                );
        }


        foreach ($dangers as $key => $val) {
            $priorities[$key] = array(
                'priority' =>$dangers[$key]
                );
        }

        foreach ($seclevels as $k => $val) {
            $secs[$k] = array(
                'seclevel' =>$seclevels[$k]
                );
        }


        foreach ($creDept as $k => $val) {
            $units[$k] = array(
                'unit' =>$creDept[$k]
                );
        }

        foreach ($bb as $k => $val) {
            $statements[$k] = array(
                'statement' =>$bb[$k],
                'type'=>0
                );
        }

        foreach ($bb2 as $k => $val) {
            $statements2[$k] = array(
                'statement' =>$bb2[$k],
                'type'=>1
                );
        }

        foreach ($action as $k => $val) {
            $action[$k] = array(
                'action' =>$action[$k]
                );
        }

		// Uncomment the below to run the seeder
        DB::table('categories')->insert($category);
        DB::table('seclevel')->insert($secs);
        DB::table('priority')->insert($priorities);
        DB::table('statements')->insert($statements);
        DB::table('statements')->insert($statements2);
        DB::table('actions')->insert($action);
        DB::table('creunits')->insert($units);
    }

}
