<?php
use Istar\Repo\Document\IDocument;
use Istar\Service\Form\Document\DocumentForm;

class DocumentsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	protected $document;
	public function __construct(IDocument $document,DocumentForm $documentform)
	{
		$this->beforeFilter('auth');
		$this->document = $document;
		$this->documentform = $documentform;
	}


	public function index()
	{
		$uid = Sentry::getId();
		$user = User::find($uid);
		$data = $this->document->getAll();

		$newInboxCount = $this->document->getNewInbox($uid);
		if ($newInboxCount >0) {
			$newInboxCount = '+'.$newInboxCount;
		}

		$auditedBox = $this->document->getAuditedBox($uid);
		if ($auditedBox==0) {
			$auditedBox = '暂无';
		}

		$newAuditCount = $this->document->getNewAuditbox($uid);
		if ($newAuditCount >0) {
			$newAuditCount = '+'.$newAuditCount;
		}

		$signedCount = $this->document->getSigned($uid);
		$outtedCount = $this->document->getOutBox($uid)->count();

		return View::make('documents.index',compact('data','user','newInboxCount','newAuditCount','auditedBox','signedCount','outtedCount'));

	}

	public function api_index()
	{
		$data = $this->document->getAll();
		return \Datatables::of($data)->make();
	}

	public function inbox()
	{
		$uid = Sentry::getUser()->id;
		$user = User::find($uid);
		return View::make('documents.inbox',compact('user'));

	}

	public function outbox()
	{
		$uid = Sentry::getUser()->id;
		$user = User::find($uid);
		return View::make('documents.outbox',compact('user'));
	}

	public function api_inbox()
	{
		$uid = Sentry::getUser()->id;
		$user = User::find($uid);
		$data = $this->document->getInBox($uid);
		return \Datatables::of($data)
		->edit_column('subject','<a href="{{ url(\'home/documents/show\', $id) }}">{{$subject}}</a>')
		->edit_column('state','@if($state==0)<span class="label label-info">未签收</span>@elseif($state==2) <span class="label label-success">已签收</span>@endif')
		->edit_column('priority','@if($priority=="紧急")<span class="label label-warning">紧急</span>@elseif($priority=="特急") <span class="label label-important">特急</span>@else<span class="label label-success">普通</span>@endif')
		->add_column('event','<a href="{{ url(\'home/documents/showTimeLine\', $id) }}" class="btn btn-primary"><i class="icon-screenshot"></i> 跟踪</a>')
		->make();
	}

	public function api_outbox()
	{
		$uid = Sentry::getUser()->id;
		$data = $this->document->getOutBox($uid);
		return \Datatables::of($data)
		->edit_column('subject','<a href="{{ url(\'home/documents/show\', $id) }}">{{$subject}}</a>')
		->edit_column('state','@if($state==0)<span class="label label-info">待批</span>@elseif($state==1) <span class="label label-warning">审批通过,待发</span>@elseif($state==-1) <span class="label label-success">预审通过</span>@elseif($state==2) <span class="label label-inverse">审批退回</span>@elseif($state==3) <span class="label label-success">已签发</span>@elseif($state==4) <span class="label label-important">已办结</span>@elseif($state==5) <span class="label">已归档</span>@endif')
		->edit_column('priority','@if($priority=="紧急")<span class="label label-warning">紧急</span>@elseif($priority=="特急") <span class="label label-important">特急</span>@else<span class="label label-success">普通</span>@endif')
		->add_column('event','<a href="{{ url(\'home/documents/showTimeLine\', $id) }}" class="btn btn-primary"><i class="icon-screenshot"></i> 跟踪</a>')
		->make();
	}

	public function api_audit()
	{
		$uid = Sentry::getUser()->id;
		$data = $this->document->getAuditBox($uid);
		return \Datatables::of($data)
		->edit_column('subject','<a href="{{ url(\'home/documents/show\', $id) }}">{{$subject}}</a>')
		->edit_column('state','@if($state==0)<span class="label label-info">待批</span>@elseif($state==1) <span class="label label-warning">审批通过,待发</span>@elseif($state==-1) <span class="label label-success">预审通过</span>@elseif($state==2) <span class="label label-inverse">审批退回</span>@elseif($state==3) <span class="label label-success">已签发</span>@elseif($state==4) <span class="label label-important">已办结</span>@elseif($state==5) <span class="label">已归档</span>@endif')
		->edit_column('priority','@if($priority=="紧急")<span class="label label-warning">紧急</span>@elseif($priority=="特急") <span class="label label-important">特急</span>@else<span class="label label-success">普通</span>@endif')
		->add_column('event','<a href="{{ url(\'home/documents/showTimeLine\', $id) }}" class="btn btn-primary"><i class="icon-screenshot"></i> 跟踪</a>')
		->make();
	}

	/**
	 * 按照给定tag id 返回公文
	 * @param  [type] $tag_id [description]
	 * @return [type]         [description]
	 */
	public function searchByTag($tag_id)
	{
		$data = $this->document->getByTag($tag_id)->documents()->paginate(10);
		$tag = Tag::find($tag_id)->tag;
		$tags = Tag::paginate(50);
		return View::make('documents.search',compact('data','tag','tags'));
	}

	/**
	 * 按照给定cat_id 返回公文
	 * @param  [type] $cat_id [description]
	 * @return [type]         [description]
	 */
	public function searchByCategory($cat_id)
	{
		$data = $this->document->getByCategory($cat_id)->documents()->paginate(10);
		$category = Category::find($cat_id)->category;
		$categories = Category::paginate(50);
		return View::make('documents.search',compact('data','category','categories'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		// 从Units中找出审批领导
		$users = Sentry::findAllUsersWithAccess('leader');
		$seclevel =  Seclevel::lists('seclevel');
		$priority = Priority::lists('priority');
		$category = Category::all();
		$creDept = Creunit::lists('unit');
		$commonSentence = Statement::where('type','=',0)->lists('statement');
		$input = Session::getOldInput();
		return View::make('documents.create',compact('users','seclevel','category','priority','creDept','commonSentence','input'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$author = Sentry::getUser(); //获取当前用户id

		$files = Input::file('files');
		$content = Input::get('content');
		if ($files[0]==NULL and $content==null) {
			return Redirect::back()->withInput()->with('error','您还没有提供公文');
		} else{
			$input = array_merge(Input::all(), array('sender_id' =>$author->id));
		}

		if ($this->documentform->save($input))
		{
			return Redirect::route('outbox')->with('success','成功创建');
		}
		else {
			return Redirect::back()
			->withInput()
			->withErrors( $this->documentform->errors() );
		}

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//获取用户id
		$uid =  \Sentry::getId();
		 //获取该用户发送的最新三篇公文
   		 // $newDocs = \Document::select('subject','id','created_at')->where('sender_id','=',$uid)->take(3)->get();
   		 //从EloquentDocument中调用，获取指定公文
		$data = $this->document->getById($id);
		 //从通过Document Model获取tags
		$tags = $data->tags()->get();
		 //获取document_user表中当前用户对该文的状态 0：未读 1：已批阅 2：已签收
		$state = $this->document->getState($id);
		 $showButtons = 'none'; //用来控制show.blade中出现的按钮,0:none,-1:拟办状态,显示修改按钮,0:待批状态,显示审核按钮,1:待批状态,普通用户显示耐心等待,2:审批通过,显示转发按钮,3:签发状态,显示办结,3:

		 switch ($state) {
		 	case '-1':
		 	if ($uid==$data->sender_id) {
		 		$showButtons = 'edit';
		 	}
		 	break;

		 	case '0':
		 	if (Sentry::getUser()->hasAnyAccess(['leader'])) {
		 		if ($this->document->getAuditboxRelate($id,$uid)=='0') {
		 			$showButtons = 'audit';
		 		} elseif ($this->document->getAuditboxRelate($id,$uid)=='1') {
		 			$showButtons='auditted';
		 		}
		 	}
		 	else $showButtons = 'waitForAudit';
		 	break;

		 	case '1':
		 	if($uid==$data->sender_id){
		 		$showButtons='redirect';
		 	} else $showButtons = 'passed';
		 	break;

		 	case '2':
		 	if($uid==$data->sender_id){
		 		$showButtons='edit';
		 	}
		 	break;

		 	case '3':
		 	if ($uid==$data->sender_id) {
		 		$showButtons = 'postDone';
		 	} elseif ($this->document->getInboxRelate($id,$uid)=='0') {
		 		$showButtons = 'sign';
		 	}else $showButtons = 'signed';

		 	break;

		 	case '4':
		 	$showButtons = 'done';
		 	break;

		 }

		 $recieversCount = count(explode(',',$data->mainSend));
		 $units = Sentry::findAllUnits();

		 $myDocs = User::find($uid)->documents()
		 				->select('id','created_at','subject')
		 				->orderby('created_at','desc')
		 				->take(5)
		 				->get();

		 return View::make('documents.show',compact('data','tags','showButtons','units','myDocs'));
		}



		public function handleDocument($id)
		{
   		 //处理提交审核
			if (\Input::has('doc_pass') || \Input::has('doc_cancel') || \Input::has('doc_preAudit')) {
				if ($this->document->postAudit($id)) {
					return Redirect::back()->with('success','公文成功审批');
				}
				else {
					return Redirect::back()
					->withInput()
					->withErrors( $this->documentform->errors() );
				}
			}
		// 处理提交签收
			elseif (\Input::has('doc_signed')) {
				if ($this->document->postSign($id)) {
					return Redirect::back()->with('success','公文成功签收');
				}
				else {
					return Redirect::back()
					->withInput()
					->withErrors( $this->documentform->errors() );
				}
			}
		// 处理办结
			elseif (\Input::has('postDone')) {
				if ($this->document->postDone($id)) {
					return Redirect::back()->with('success','公文已办结');
				}
				else {
					return Redirect::back()
					->withInput()
					->withErrors( $this->documentform->errors() );
				}
			}

		//处理转发
			elseif (\Input::has('redirect')) {

				$inputs = Input::get('recievers');
				if ($this->document->redirect($id,$inputs)) {
					return Redirect::route('outbox')->with('success','成功创建');
				}
				else {
					return Redirect::back()
					->withInput()
					->withErrors( $this->documentform->errors() );
				}
			}
		}

		public function auditHome()
		{
			$uid = Sentry::getUser()->id;
			$user = User::find($uid);
			return View::make('documents.audit',compact('user'));
		}


		public function audit($id)
		{
		//获取用户id
			$uid =  \Sentry::getId();
		 //获取该用户发送的最新三篇公文
			$newDocs = \Document::select('subject','id','created_at')->where('sender_id','=',$uid)->take(3)->get();
   		 //从EloquentDocument中调用，获取指定公文
			$data = $this->document->getById($id);
		 //从通过Document Model获取tags
			$tags = $data->tags()->get();
		 //获取document_user表中当前用户对该文的状态 0：未读 1：已批阅 2：已签收
			$state = DB::table('document_user')
			->select('state')
			->where('user_id','=',$uid)
			->where('document_id','=',$id)
			->first();
		 //$state 返回 stdClass，故加入判断
			if ($state == NULL) {
				$state_type = 8;
			}
			else {
				$state_type = $state->state;
			}
		 //获取该公文的签收意见
			$comments = $data->comments()->get();
			return View::make('documents.showAudit',compact('data','newDocs','tags','comments','state_type'));
		}

		public function done($id)
		{

		//获取用户id
			$uid =  \Sentry::getId();
		 //获取该用户发送的最新三篇公文
   		 // $newDocs = \Document::select('subject','id','created_at')->where('sender_id','=',$uid)->take(3)->get();
   		 //从EloquentDocument中调用，获取指定公文
			$data = $this->document->getById($id);
		 //从通过Document Model获取tags
			$tags = $data->tags()->get();
		 //获取document_user表中当前用户对该文的状态 0：未读 1：已批阅 2：已签收
			$state = DB::table('document_user')
			->select('state')
			->where('user_id','=',$uid)
			->where('document_id','=',$id)
			->first();

		 //$state 返回 stdClass，故加入判断
			if ($state == NULL) {
				$state_type = 8;
			}
			else {
				$state_type = $state->state;
			}

			$recieversCount = count(explode(',',$data->mainSend));


			return View::make('documents.done',compact('data','tags','state_type','recieversCount'));
		}


		public function docflow($id)
		{
			$data = $this->document->getById($id);
			$flows = $data->docflows()->get();
			$docid = $id;
			return View::make('documents.docflow',compact('flows','docid'));
		}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// 从Units中找出审批领导
		$users = Sentry::findAllUsersWithAccess('leader');
		$seclevel =  Config::get('site_const.seclevel');
		$priority = Config::get('site_const.priority');
		$category = Category::all();
		$creDept = Config::get('site_const.creDept');
		$commonSentence = Config::get('site_const.commonSentence');
		$data = $this->document->getById($id);
		$tags = '';
		$data->tags->each(function($tag) use(&$tags)
		{
			$tags .= $tag->tag.' ';
		});
		$tags = trim($tags);
		return View::make('documents.edit',compact('data','users','seclevel','category','priority','creDept','commonSentence','input','tags'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$author = Sentry::getUser(); //获取当前用户id
		$files = Input::file('files');
		$content = Input::get('content');
		// if ($files[0]==NULL and $content==null) {
		// 	return Redirect::back()->withInput()->with('error','您还没有提供公文');
		// } else{}
			$input = array_merge(Input::all(), array('sender_id' =>$author->id,'id'=>$id));


		if ($this->documentform->update($input))
		{
			return Redirect::route('outbox')->with('success','成功提交');
		}
		else {
			return Redirect::back()
			->withInput()
			->withErrors( $this->documentform->errors() );
		}
	}

	public function redirect($id)
	{

		//获取用户id
		$uid =  \Sentry::getId();
		 //获取该用户发送的最新三篇公文
		$newDocs = \Document::select('subject','id','created_at')->where('sender_id','=',$uid)->take(3)->get();
   		 //从EloquentDocument中调用，获取指定公文
		$data = $this->document->getById($id);
		 //从通过Document Model获取tags
		$tags = $data->tags()->get();
		 //获取document_user表中当前用户对该文的状态 0：未读 1：已批阅 2：已签收
		$state = DB::table('document_user')
		->select('state')
		->where('user_id','=',$uid)
		->where('document_id','=',$id)
		->first();
		 //$state 返回 stdClass，故加入判断
		if ($state == NULL) {
			$state_type = 8;
		}
		else {
			$state_type = $state->state;
		}

		 //获取该公文的签收意见
		$comments = $data->comments()->get();
		$units = Sentry::findAllUnits();
		return View::make('documents.redirect',compact('data','newDocs','tags','comments','state_type','units'));
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}