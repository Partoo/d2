<?php
namespace admin;
use Istar\Repo\Document\IDocument;
use Istar\Service\Form\Document\DocumentForm;
use View;

class DocsController extends \BaseController {

	protected $document;
	public function __construct(IDocument $document,DocumentForm $documentform)
	{
		$this->beforeFilter('auth');
		$this->document = $document;
		$this->documentform = $documentform;
	}


	public function index()
	{
		return View::make('admin.docs.index');
	}

	public function docManageAPI()
	{
		$data = $this->document->getAll();
		return \Datatables::of($data)->make();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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