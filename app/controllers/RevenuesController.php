<?php

class RevenuesController extends BaseController {

	/**
	 * Revenue Repository
	 *
	 * @var Revenue
	 */
	protected $revenue;

	public function __construct(Revenue $revenue)
	{
		$this->revenue = $revenue;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$revenues = $this->revenue->all();

		return View::make('revenues.index', compact('revenues'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$categories = Rtype::lists('name', 'type');
		$projects = Project::lists('name', 'type');
		return View::make('revenues.create', compact('categories', 'projects'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$revenue = new Revenue;
		$revenue->project = Input::get('project');
		$revenue->type = Input::get('type');
		$revenue->narration = Input::get('narration');
		$revenue->amount = Input::get('amount');	
		$revenue->creator = Auth::user()->username; 
		$validation = Validator::make(Input::all(), Revenue::$rules);

		if ($validation->passes())
		{

			$revenue->save();
			Flash::success('Revenue Added');			
			return Redirect::route('revenues.index');
		}		
		return Redirect::route('revenues.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$revenue = $this->revenue->findOrFail($id);

		return View::make('revenues.show', compact('revenue'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if(Auth::user()->role == 'Admin')
		{
			$revenue = $this->revenue->find($id);

		if (is_null($revenue))
		{	
			Flash::error('Item does not exist');
			return Redirect::route('revenues.index');
		}

		$categories = Rtype::lists('name', 'type');
		$projects = Project::lists('name', 'type');
		return View::make('revenues.edit', compact('revenue', 'projects', 'categories'));
		}
		else {
			Flash::error('You are not authorized to do so');
			return Redirect::back();
		}		
	}
		

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, Revenue::$rules);

		if ($validation->passes())
		{
			$revenue = $this->revenue->find($id);
			$revenue->update($input);

			return Redirect::route('revenues.show', $id);
		}

		return Redirect::route('revenues.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(Auth::user()->role == 'Admin'){
			$this->revenue->find($id)->delete();
			Flash::success('Revenue Deleted');
			return Redirect::route('revenues.index');
		}
		else{
			Flash::error('You are not authorized to do this');
			return Redirect::back();
		}		
	}

}
