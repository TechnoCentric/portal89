<?php

class EtypesController extends BaseController {

	/**
	 * Etype Repository
	 *
	 * @var Etype
	 */
	protected $etype;

	public function __construct(Etype $etype)
	{
		$this->etype = $etype;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Auth::user()->role == 'Admin')
		{
			$etypes = $this->etype->paginate(10);
			$expenses = Expense::all();

			return View::make('etypes.index', compact('etypes', 'expenses'));
		}
		Flash::error('You are not authorized to view this page');
		return Redirect::to('home');
		
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(Auth::user()->role == 'Admin')
		{
			return View::make('etypes.create');
		}
		Flash::error('You are not authorized to view this page');
		return Redirect::to('home');		
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Etype::$rules);

		if ($validation->passes())
		{
			$etype = new Etype();
			$etype->name = Input::get('name');
			$etype->type = Input::get('name');
			$etype->save();

			Flash::success('Expense type created');
			return Redirect::route('etypes.index');
		}
		Flash::error('There were validation errors');
		return Redirect::route('etypes.create')
			->withInput()
			->withErrors($validation);

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		if(Auth::user()->role == 'Admin')
		{
			$etype = $this->etype->findOrFail($id);

			return View::make('etypes.show', compact('etype'));
		}
		Flash::error('You are not authorized to view this page');
		return Redirect::to('home');			
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
			$etype = $this->etype->find($id);

			if (is_null($etype))
			{
				return Redirect::route('etypes.index');
			}

			return View::make('etypes.edit', compact('etype'));
		}
		Flash::error('You are not authorized to view this page');
		return Redirect::to('home');					
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
		$validation = Validator::make($input, Etype::$rules);

		if ($validation->passes())
		{
			$etype = $this->etype->find($id);
			$etype->update($input);

			return Redirect::route('etypes.show', $id);
		}
		Flash::error('There were validation errors');
		return Redirect::route('etypes.edit', $id)
			->withInput()
			->withErrors($validation);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->etype->find($id)->delete();

		return Redirect::route('etypes.index');
	}

}
