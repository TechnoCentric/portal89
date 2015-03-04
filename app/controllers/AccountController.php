<?php

class AccountController extends BaseController {

	/**
	 * Display a User's dashboard
	 *
	 * @return Response
	 */
	public function dashboard()
	{

		return View::make('account.dashboard');
	}	

	/**
	 * Show the form for Changing password.
	 *
	 *   
	 * @return Response
	 */
	public function getChangePassword()
	{		
		return View::make('account.edit');
	}

	/**
	 * Change User's Password.
	 *
	 * 
	 * @return change password
	 */
	public function postChangePassword()
	{
		$rules = array(	
			'password' => 'required|min:8',
			'password_confirmation' => 'required|same:password',			
		);

		$validator = Validator::make(Input::except('_method'), $rules);
	    if($validator->passes()){
	        $user = Auth::user();
            $user->password = Hash::make(Input::get('password'));
            $user->save();
            Flash::success('Password reset successful');
            return Redirect::back();        
	    }
	    return Redirect::back()->withErrors($validator);
	}	
}
