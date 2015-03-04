<?php

class SessionsController extends BaseController {


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('sessions.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(Auth::check()) {
			Flash::warning('You are already logged in');
			return Redirect::to('home');
		}
        return View::make('sessions.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{		
		$input = Input::all();

		$rules = array(
		'username'             => 'required', 						// just a normal required validation
		'password'         => 'required',
		);
		$validation = Validator::make($input,$rules);
		if($validation->fails()){
			Flash::error('There were validation errors');
			return Redirect::to('/login')->withInput()->withErrors($validation);
		} 
		$attempt = Auth::attempt([
			'username' => $input['username'],
			'password' => $input['password']


		]);

		if ($attempt) {
			Flash::success('Login Successful');
			return Redirect::intended('/home');
		}
		Flash::error('Username/password combination incorrect');
		return Redirect::to('/login')->withInput();

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('sessions.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('sessions.edit');
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
	public function destroy()
	{
		Auth::logout();
		Flash::message('You have Logged Out');
		return Redirect::to('/login');

	}

}
