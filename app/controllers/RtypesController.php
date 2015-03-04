<?php

class RtypesController extends BaseController {

	/**
	 * Rtype Repository
	 *
	 * @var Rtype
	 */
	protected $rtype;

	public function __construct(Rtype $rtype)
	{
		$this->rtype = $rtype;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Auth::user()->role =='Admin')
		{
			$rtypes = $this->rtype->all();

			return View::make('rtypes.index', compact('rtypes'));
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

		if(Auth::user()->role =='Admin')
		{
			return View::make('rtypes.create');
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
		$validation = Validator::make($input, Rtype::$rules);

		if ($validation->passes())
		{
			$this->rtype->create($input);

			return Redirect::route('rtypes.index');
		}

		return Redirect::route('rtypes.create')
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

		if(Auth::user()->role =='Admin')
		{
			$rtype = $this->rtype->findOrFail($id);

			return View::make('rtypes.show', compact('rtype'));
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
		if(Auth::user()->role =='Admin')
		{
			$rtype = $this->rtype->find($id);

			if (is_null($rtype))
			{
				return Redirect::route('rtypes.index');
			}

			return View::make('rtypes.edit', compact('rtype'));
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
		$validation = Validator::make($input, Rtype::$rules);

		if ($validation->passes())
		{
			$rtype = $this->rtype->find($id);
			$rtype->update($input);

			return Redirect::route('rtypes.show', $id);
		}

		return Redirect::route('rtypes.edit', $id)
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
		$this->rtype->find($id)->delete();

		return Redirect::route('rtypes.index');
	}

}
