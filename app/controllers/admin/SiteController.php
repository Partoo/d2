<?php
namespace admin;
use Validator,View,Input,Config;
class SiteController extends \BaseController {



	public function index()
	{
		return View::make('admin.site.index');
	}

	public function handlePost()
	{
		$siteName = Input::get('sitename');
		$adminPhone = Input::get('adminPhone');

		if (Input::has('siteOn'))
		{
			$siteOn = Input::get('siteOn');
			if ($siteOn=='0') {
				\Setting::set('site.siteOn', true);
			}else{
				\Setting::set('site.siteOn', false);
			}
		}

		if (Input::has('signEnabled'))
		{
			$signEnabled = Input::get('signEnabled');
			if ($signEnabled=='0') {
				\Setting::set('site.signEnabled', true);
			}else{
				\Setting::set('site.signEnabled', false);
			}
		}

		\Setting::set('site.siteName', $siteName);
		\Setting::set('site.siteAdminPhone', $adminPhone);

		return \Redirect::route('site')->with('success', '修改成功');
	}


}