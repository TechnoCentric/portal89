<?php

use Illuminate\Auth\UserTrait;  
use Illuminate\Auth\UserInterface;  

class User extends Eloquent implements UserInterface {
	use UserTrait;
	protected $guarded = array('id','password','remember_token');

	public static $rules = array(
		'username' => 'required',
		'email' => 'required|unique:users',
		'password' => 'required|min:8',
		'password_confirmation' => 'required|same:password',
		'role' => 'required'
	);
}
