<?php

class UsersController extends BaseController {

	/**
	 * User Repository
	 *
	 * @var User
	 */
	protected $User;

	public function __construct(User $User)
	{
		$this->User = $User;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$Users = $this->User->paginate(10);
		if(Auth::user()->role == 'Admin'){
			return View::make('users.index', compact('Users'));
		}
		
		Flash::error('Your account is not authorized to view this page');
		return Redirect::to('/');
		
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$roles = DB::table('roles')->lists('name', 'role');
		if(Auth::user()->role == 'Admin'){
			return View::make('users.create', compact('roles'));
		}
		
		Flash::error('Your account is not authorized to view this page');
		return Redirect::to('home');
		
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if (Auth::user()->role == 'Admin') {
			$input = Input::all();
			$validation = Validator::make($input, User::$rules);

			if ($validation->passes()){
				$user = new User();
				$user->username = Input::get('username');
				$user->email = Input::get('email');
				$user->password = Hash::make(Input::get('password'));
				$user->role = Input::get('role');
				$user->save();
				
				Flash::success('User Created');
				return Redirect::route('users.index');
			}
				
			return Redirect::route('users.create')
				->withInput()
				->withErrors($validation);
		}
		Flash::error('Your account is not authorized to view this page');
		return Redirect::to('home');	
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$User = $this->User->findOrFail($id);

		if (Auth::user()->role == 'Admin') {
			return View::make('users.show', compact('User'));
		}
		Flash::error('Your account is not authorized to view this page');
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
		if (Auth::user()->role == 'Admin') {
			$User = $this->User->find($id);

			if (is_null($User))
				{
				Flash::error('User not found');
				return Redirect::route('users.index');
			}

			return View::make('users.edit', compact('User'));
		}
		Flash::error('Your account is not authorized to view this page');
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

		if (Auth::user()->role == 'Admin') {
			$input = array_except(Input::all(), '_method');
			$validation = Validator::make($input, User::$rules);

			if ($validation->passes())
			{
				$User = $this->User->find($id);
				$User->update($input);
				Flash::success('User updated');
				return Redirect::route('users.show', $id);
			}	

			return Redirect::route('users.edit', $id)
				->withInput()
				->withErrors($validation);
		}
		Flash::error('Your account is not authorized to view this page');
		return Redirect::to('home');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if (Auth::user()->role == 'Admin') {
			$this->User->find($id)->delete();
			Flash::success('User Deleted');
			return Redirect::route('users.index');
		}
		Flash::error('Your account is not authorized to view this page');
		return Redirect::to('home');
	}

}
