<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		return View::make('hello');
	}

	public function home(){
		$Expenses = Expense::all()->take(5);
		$projects = Project::all()->take(5);
		$etypes = Etype::all()->take(5);
		return View::make('home', compact('Expenses', 'projects', 'etypes'));
	}

}
