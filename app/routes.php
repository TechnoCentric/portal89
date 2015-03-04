<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::group(array('before' => 'auth'), function()
{

Route::get('/', array (
	'as' => 'home',
	'uses' => 'HomeController@home'
));
Route::resource('expenses', 'ExpensesController');

Route::resource('etypes', 'EtypesController');

Route::resource('projects', 'ProjectsController');


Route::get('/report', array(
	'as'=>'report',
	'uses' => 'ExpensesController@getReport'

));
Route::post('expenses/search',array(
			'as' => 'expenses.search',
			'uses' => 'ExpensesController@search'
			))->before('csrf');
Route::post('/results', array(
	'as'=>'results',
	'uses' => 'ExpensesController@postReport'
))->before('csrf');
Route::post('/excel', array(
	'as'=>'excel',
	'uses' => 'ExpensesController@toExcel'

))->before('csrf');


Route::resource('users', 'UsersController');

Route::get('home', 'HomeController@home');
Route::get('/dashboard', array(
	'as' => 'account.dashboard',
	'uses' => 'AccountController@dashboard'

	));
Route::get('/edit', array(
	'as' => 'account.edit',
	'uses' => 'AccountController@getChangePassword'

	));
Route::post('/edit', array(
	'as' => 'account.edit',
	'uses' => 'AccountController@postChangePassword'

	))->before('csrf');
Route::resource('revenues', 'RevenuesController');

Route::resource('revenue_types', 'Revenue_typesController');

Route::resource('rtypes', 'RtypesController');
});

Route::get('login', [
	'as' => 'login_path',
	'uses' => 'SessionsController@create'
	]);
Route::post('login', [
	'as' => 'login_path',
	'uses' => 'SessionsController@store'
	])->before('csrf');
Route::get('logout', [
	'as' => 'logout_path',
	'uses' => 'SessionsController@destroy'
	]);



