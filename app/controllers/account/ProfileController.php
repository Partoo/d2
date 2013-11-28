<?php
namespace account;
use Profile,Group,Unit,User;
use Input;
use Sentry;
use View;
use Redirect;
class ProfileController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function __construct()
	{
		$this->beforeFilter('auth');
	}

	public function dashboard()
	{
		return \Redirect::to('account/profile');
	}

	public function index()
	{
		$user = Sentry::getUser();
		$id = $user->id;
		$isNull = $user->profile;
		$profile = Profile::where('user_id','=',$id)->first();
		$groups=Sentry::getGroupProvider()->createModel()->paginate();
		$units=Sentry::getUnitProvider()->createModel()->paginate();
		$myunit = $user->getUnits()->lists("name");
		return View::make('profile.default',compact('user','id','profile','isNull','units','groups','myunit'));


	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$user = Sentry::getUser();
		$id = $user->id;
		$isNull = $user->profile;
		if (is_null($isNull)) {
			$profile = new Profile();
			$profile->user_id = $id;
			$profile->birth = date('Y-m-d');
			$profile = $user->profile()->save($profile);
			$user->profile = $profile->id;
			$user->save();
		}
		return Redirect::to('account/profile');
	}



	public function changeProfile()
	{

		$user = Sentry::getUser();
		$id = $user->id;
		$profile = Profile::where('user_id','=',$id)->first();
		$profile->nickname = Input::get('nickname');
		$profile->qq = Input::get('qq');
		$profile->birth = Input::get('birth');
		$profile->intro = Input::get('intro');
		$profile->weibo = Input::get('weibo');

		if(Input::hasFile('avatar'))
		{
			$file = Input::file('avatar');
			$destinationPath = 'img/avatar/'.$id.'/';
			if(!file_exists($destinationPath))
			{
			     shell_exec("mkdir -p $destinationPath");
			}
			$filename = date('YmdHis').rand(100,999).'.'.$file->getClientOriginalExtension();
			$filepath = $destinationPath.$filename;
			\Image::make($file->getRealPath())->resize(154,154)->save($filepath);
			$profile->avatar = $filepath;
		}

		if ($profile = $user->profile()->save($profile)) return Redirect::back()->with('success', '您已成功完成个人资料修改');
		return Redirect::back()->withInput()->withErrors($profile->errors);
	}

	public function changemail()
	{
		$validation = new \Libs\Validators\EmailValidator();
		$user = Sentry::getUser();
		if (!$user->checkPassword(Input::get('password'))) {
			return Redirect::back()->with('error','您输入的密码不正确');
		}
		if ($validation->passes()) {

			$user->email = Input::get('email');
			$user->save();
			return Redirect::back()->with('success', '您已成功完成个人资料修改');
		}
		return Redirect::back()->withInput()->with('error',$validation->getErrors());
	}

	public function changename()
	{
		$validation = new \Libs\Validators\UsernameValidator();
		$user = Sentry::getUser();
		if (!$user->checkPassword(Input::get('password'))) {
			return Redirect::back()->with('error','您输入的密码不正确');
		}
		if ($validation->passes()) {

			$user->username = Input::get('username');
			$user->save();
			return Redirect::back()->with('success', '您已成功完成个人资料修改');
		}
		return Redirect::back()->withInput()->with('error',$validation->getErrors());
	}

	public function changephone()
	{
		$validation = new \Libs\Validators\PhoneValidator();
		$user= Sentry::getUser();
		$user->phone = Input::get('phone');
		$mcode = Input::get('mcode');

		if (\Session::get('mcode') != input::get('authCode')) {
			return Redirect::back()->with('error','您输入的验证码不正确');
		}
		if ($validation->passes()) {
			$user->save();
			return Redirect::back()->with('success', '您已成功完成个人资料修改');
		}
		return Redirect::back()->withInput()->with('error',$validation->getErrors());
	}

	public function changeunit()
	{

		$user= Sentry::getUser();
		if ( ! $user->checkPassword(Input::get('password')))
		{
			return Redirect::back()->with('error','您输入的密码不正确');
		}

			//获取当前部门编号
			$userUnit = $user->units()->lists('unit_id');
			$currentUnitId = $userUnit[0];
			//获取用户选取的部门编号
			$selectedUnitId = Input::get('unit');
			//比较两个编号
			if ($currentUnitId != $selectedUnitId) {
				$unitToAdd = Sentry::getUnitProvider()->findById($selectedUnitId);
				$unitToRemove = Sentry::getUnitProvider()->findById($currentUnitId);
				$user->removeUnit($unitToRemove);
				$user->addUnit($unitToAdd);
				return Redirect::back()->with('success', '您已成功完成个人资料修改');
			}else{
				return Redirect::back()->with('info', '您似乎没有更改什么');
			}

	}

	public function changePassword()
	{
		$validation = new \Libs\Validators\PasswordValidator();
		$user= Sentry::getUser();
		if ( ! $user->checkPassword(Input::get('old_password')))
		{
			return Redirect::back()->with('error','您输入的密码不正确');
		}
		if ($validation->passes()) {
			$user->password = Input::get('password');
			$user->save();
			return Redirect::back()->with('success', '您已成功完成个人资料修改');
		}
		return Redirect::back()->withInput()->with('error',$validation->getErrors());

	}


}
