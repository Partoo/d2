<?php namespace admin;

use Cartalyst\Sentry\Users\LoginRequiredException;
use Cartalyst\Sentry\Users\PasswordRequiredException;
use Cartalyst\Sentry\Users\UserExistsException;
use Cartalyst\Sentry\Users\UserNotFoundException;
use Config;
use Input;
use Lang;
use Redirect;
use Sentry;
use Validator;
use View;
class UnitsController extends \BaseController {

	function __construct() {
		$this->beforeFilter('admin-auth');

	}
	protected $validationRules = array(
		'unitname' =>'required'
		);

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		return View::make('admin.units.index');
	}

	/**
	 * 获取部门datatables数据
	 * @return [type] [description]
	 */
	public function getIndex()
	{

		// {{ route(\'delete/unit\', $id) }}
		$units = \DB::table('units')->select('id','name','created_at');
		return \Datatables::of($units)
		->add_column('operation','<a href="{{ route(\'update/unit\', $id) }}" class="btn btn-primary btn-mini">编辑</a>    <a href="{{route(\'delete/unit\', $id)}}" class="btn btn-danger btn-mini del">删除</a>')
		->make();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.units.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array('name' => 'required');
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails())
		{
			return Redirect::back()->withInput()->withErrors($validator);
		}

		try
		{

			// Get the inputs, with some exceptions
			$inputs = Input::except('_token');

			if ($unit = Sentry::getUnitProvider()->create($inputs))
			{
				return Redirect::route('units')->with('success', Lang::get('admin/units/message.success.create'));
			}

			return Redirect::route('create/unit')->with('error', Lang::get('admin/units/message.error.create'));
		}
		catch (NameRequiredException $e)
		{
			$error = 'unit_name_required';
		}
		catch (UnitsExistsException $e)
		{
			$error = 'unit_exists';
		}


		return Redirect::route('create/unit')->withInput()->with('error', Lang::get('admin/units/message.'.$error));
	}



	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		try {
			$unit = Sentry::getUnitProvider()->findById($id);
		}
		catch (UnitNotFoundException $e)
		{
			// Redirect to the groups management page
			return Rediret::route('units')->with('error', Lang::get('admin/units/message.group_not_found', compact('id')));
		}

		$rules = array('name'=>'required');
		$validator = Validator::make(Input::all(),$rules);
		if ($validator->fails()) {
			return Redirect::back()->withInput()->withErrors($validator);
		}

		try {
			$unit->name = Input::get('name');

			if ($unit->save()) {
				return Redirect::route('update/unit', $id)->with('success','部门修改成功');
			}
			else
			{
				return Redirect::route('update/unit', $id)->with('error', '部门修改失败');
			}
		}

		catch (NameRequiredException $e)
		{
			$error = Lang::get('admin/group/message.group_name_required');
		}

		return Redirect::route('update/unit', $id)->withInput()->with('error', $error);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$unit = Sentry::getUnitProvider()->findById($id);
		return View::make('admin.units.edit',compact('unit'));
	}

	/**
	 * 用于datatables调用的动态格式
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function showUnit($id)
	{
		// 判断当前部门是否存在用户,不存在则提供datatables空格式
		$unit = Sentry::getUnitProvider()->findById($id);
		if (empty($unit->users()->lists('username'))) {
			echo '{"sEcho":1,"iTotalRecords":"0","iTotalDisplayRecords":"0","aaData":[]}';
		}
		else{
			$users = \DB::table('units')
			->leftjoin('users_units','users_units.unit_id','=','units.id')
			->leftjoin('users','users.id','=','users_units.user_id')
			->where('units.id','=',$id)
			->select('users.id','users.username','users.phone','users.created_at');
			return \Datatables::of($users)
			->add_column('operator','<a href="{{ route(\'update/user\', $id) }}" class="btn btn-primary btn-mini">编辑</a>    <a href="{{route(\'delete/user\', $id)}}" class="btn btn-danger btn-mini">删除</a>')
			->make();
		}
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
			// Get user information
			$unit = Sentry::getUnitProvider()->findById($id);
			$unit->delete();
			return Redirect::route('units')->with('success','部门删除成功');
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