<?php namespace admin;
use AdminController;
use Cartalyst\Sentry\Groups\GroupExistsException;
use Cartalyst\Sentry\Groups\GroupNotFoundException;
use Cartalyst\Sentry\Groups\NameRequiredException;
use Config;
use Input;
use Lang;
use Redirect;
use Sentry;
use Validator;
use View;

class GroupsController extends AdminController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('admin.groups.index');
	}

	public function getIndex()
	{
		$groups = \DB::table('groups')->select('id','name','created_at');
		return \Datatables::of($groups)
		->add_column('operation','<a href="{{ route(\'update/group\', $id) }}" class="btn btn-primary btn-mini">编辑</a>    <a href="{{route(\'delete/group\', $id)}}" class="btn btn-danger btn-mini del">删除</a>')
		->make();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		// 获取所有可用权限
		$permissions = Config::get('permissions');
		$this->encodeAllPermissions($permissions, true);

		// Selected permissions
		$selectedPermissions = Input::old('permissions', array());

		// Show the page
		return View::make('admin.groups.create', compact('permissions', 'selectedPermissions'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'name' => 'required',
			);

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}
		try
		{
			// We need to reverse the UI specific logic for our
			// permissions here before we create the user.
			$permissions = Input::get('permissions', array());
			$this->decodePermissions($permissions);
			app('request')->request->set('permissions', $permissions);

			// Get the inputs, with some exceptions
			$inputs = Input::except('_token');

			// Was the group created?
			if ($group = Sentry::getGroupProvider()->create($inputs))
			{
				// Redirect to the new group page
				return Redirect::route('groups')->with('success', Lang::get('admin/groups/message.success.create'));
			}

			// Redirect to the new group page
			return Redirect::route('create/group')->with('error', Lang::get('admin/groups/message.error.create'));
		}
		catch (NameRequiredException $e)
		{
			$error = '您需要填写群组名称';
		}
		catch (GroupExistsException $e)
		{
			$error = '已经有这个群组了';
		}

		// Redirect to the group create page
		return Redirect::route('create/group')->withInput()->with('error', $error);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		try
		{
			// Get the group information
			$group = Sentry::getGroupProvider()->findById($id);

			// Get all the available permissions
			$permissions = Config::get('permissions');
			$this->encodeAllPermissions($permissions, true);

			// Selected permissions
			$selectedPermissions = Input::old('permissions', array());

			// Get this group permissions
			$groupPermissions = $group->getPermissions();
			$this->encodePermissions($groupPermissions);
			$groupPermissions = array_merge($groupPermissions, Input::old('permissions', array()));
		}
		catch (GroupNotFoundException $e)
		{
			// Redirect to the groups management page
			return Redirect::route('groups')->with('error', Lang::get('admin/groups/message.group_not_found', compact('id')));
		}

		// Show the page
		return View::make('admin.groups.edit', compact('group', 'permissions', 'groupPermissions'));
	}

	/**
	 * 用于datatables调用的动态格式
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function showGroup($id)
	{
		// 判断当前群组是否存在用户,不存在则提供datatables空格式
		$group = Sentry::getGroupProvider()->findById($id);
		if (empty($group->users()->lists('username'))) {
			echo '{"sEcho":1,"iTotalRecords":"0","iTotalDisplayRecords":"0","aaData":[]}';
		}
		else{
			$users = \DB::table('groups')
			->leftjoin('users_groups','users_groups.group_id','=','groups.id')
			->leftjoin('users','users.id','=','users_groups.user_id')
			->where('groups.id','=',$id)
			->select('users.id','users.username','users.phone','users.created_at');
			return \Datatables::of($users)
			->add_column('operator','<a href="{{ route(\'update/user\', $id) }}" class="btn btn-primary btn-mini">编辑</a>    <a href="{{route(\'delete/user\', $id)}}" class="btn btn-danger btn-mini">删除</a>')
			->make();
		}
	}


	public function update($id)
	{

		$permissions = Input::get('permissions', array());
		$this->decodePermissions($permissions);
		app('request')->request->set('permissions', $permissions);

		try
		{
			// Get the group information
			$group = Sentry::getGroupProvider()->findById($id);
		}
		catch (GroupNotFoundException $e)
		{
			// Redirect to the groups management page
			return Rediret::route('groups')->with('error', Lang::get('admin/groups/message.group_not_found', compact('id')));
		}

		$rules = array('name'=>'required');
		$validator = Validator::make(Input::all(),$rules);
		if ($validator->fails()) {
			return Redirect::back()->withInput()->withErrors($validator);
		}

		try {

			$group->name = Input::get('name');
			$group->permissions = Input::get('permissions');

			if ($group->save()) {
				return Redirect::route('update/group', $id)->with('success','群组修改成功');
			}
			else
			{
				return Redirect::route('update/group', $id)->with('error', '群组修改失败');
			}
		}

		catch (NameRequiredException $e)
		{
			$error = Lang::get('admin/group/message.group_name_required');
		}

		return Redirect::route('update/group', $id)->withInput()->with('error', $error);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		try
		{
			$user = Sentry::getUser();
			$currentGroup = Sentry::findGroupById($id);
			if ($user->inGroup($currentGroup)) {
				return Redirect::route('groups')->with('error','不能删除你所在的群组');
			}
			else {
				$currentGroup->delete();
				return Redirect::route('groups')->with('success','群组删除成功');
			}
		}

		catch (UserNotFoundException $e)
		{
			// Prepare the error message
			$error = Lang::get('admin/users/message.user_not_found', compact('id' ));

			// Redirect to the user management page
			return Redirect::route('users')->with('error', $error);
		}
	}

}