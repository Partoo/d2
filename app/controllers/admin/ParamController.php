<?php  namespace admin;
use Validator,View,Input,Config;

class ParamController extends \BaseController {

	public function index()
	{
		return View::make('admin.param.home');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index_category()
	{
		$lists = \Category::orderBy('id')->get();
		return View::make('admin.param.index_category',compact('lists'));
	}

	public function index_unit()
	{
		$lists = \Creunit::orderBy('id')->get();
		return View::make('admin.param.index_unit',compact('lists'));
	}

	public function index_priority()
	{
		$lists = \Priority::orderBy('id')->get();
		return View::make('admin.param.index_priority',compact('lists'));
	}

	public function index_seclevel()
	{
		$lists = \Seclevel::orderBy('id')->get();
		return View::make('admin.param.index_seclevel',compact('lists'));
	}

	public function index_statement()
	{
		$lists = \Statement::orderBy('id')->get();
		return View::make('admin.param.index_statement',compact('lists'));
	}

	public function index_action()
	{
		$lists = \Action::orderBy('id')->get();
		return View::make('admin.param.index_action',compact('lists'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$inputs = Input::all();
		if (Input::has('category')) {
			$serie = new \Category;
			$serie->category = $inputs['category'];
		}elseif (Input::has('unit')) {
			$serie = new \Creunit;
			$serie->unit = $inputs['unit'];
		}elseif (Input::has('priority')) {
			$serie = new \Priority;
			$serie->priority = $inputs['priority'];
		}elseif (Input::has('seclevel')) {
			$serie = new \Seclevel;
			$serie->seclevel = $inputs['seclevel'];
		}elseif (Input::has('statement')) {
			$serie = new \Statement;
			$serie->statement = $inputs['statement'];
			$serie->type = $inputs['type'];
		}elseif (Input::has('action')) {
			$serie = new \Action;
			$serie->action = $inputs['action'];
		}

		try {
			if ($serie->save()) {
				return "{\"id\": ".$serie->id."}";
			}
		} catch (\Exception $e) {
			return '您输入的记录已存在或格式不正确';
			// return $inputs;
		}

	}



	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
		$inputs = Input::all();

		switch ($inputs['name']) {
			case 'category':
				$serie = \Category::find($inputs['pk']);
				break;

			case 'unit':
				$serie = \Creunit::find($inputs['pk']);
				break;
			case 'priority':
				$serie = \Priority::find($inputs['pk']);
				break;
			case 'seclevel':
				$serie = \Seclevel::find($inputs['pk']);
				break;
			case 'statement':
				$serie = \Statement::find($inputs['pk']);
				break;
			case 'type':
				$serie = \Statement::find($inputs['pk']);
				break;
			case 'action':
				$serie = \Action::find($inputs['pk']);
				break;

		}


		$serie->$inputs['name'] = $inputs['value'];

			if ($serie->save()) {
				return "修改成功";
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

		$category = \Category::find($id);
		try {
			if ($category->delete()) {
				return \Redirect::back()->with('success', '删除成功');
			}
		} catch (\Exception $e) {
			return \Redirect::back()->with('error', '删除不成功');
		}
	}

	public function destroy_unit($id)
	{

		$category = \Creunit::find($id);
		try {
			if ($category->delete()) {
				return \Redirect::back()->with('success', '删除成功');
			}
		} catch (\Exception $e) {
			return \Redirect::back()->with('error', '删除不成功');
		}
	}
	public function destroy_seclevel($id)
	{

		$category = \Seclevel::find($id);
		try {
			if ($category->delete()) {
				return \Redirect::back()->with('success', '删除成功');
			}
		} catch (\Exception $e) {
			return \Redirect::back()->with('error', '删除不成功');
		}
	}
	public function destroy_action($id)
	{

		$category = \Action::find($id);
		try {
			if ($category->delete()) {
				return \Redirect::back()->with('success', '删除成功');
			}
		} catch (\Exception $e) {
			return \Redirect::back()->with('error', '删除不成功');
		}
	}
	public function destroy_priority($id)
	{

		$category = \Priority::find($id);
		try {
			if ($category->delete()) {
				return \Redirect::back()->with('success', '删除成功');
			}
		} catch (\Exception $e) {
			return \Redirect::back()->with('error', '删除不成功');
		}
	}
	public function destroy_statement($id)
	{

		$category = \Statement::find($id);
		try {
			if ($category->delete()) {
				return \Redirect::back()->with('success', '删除成功');
			}
		} catch (\Exception $e) {
			return \Redirect::back()->with('error', '删除不成功');
		}
	}
}