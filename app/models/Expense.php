<?php

use Laracasts\Presenter\PresentableTrait;

class Expense extends Eloquent {
	

	use PresentableTrait;
	protected $presenter = 'Dexter\Presenters\Expense';
	protected $guarded = array();

	public static $rules = array(
		'type' => 'required',
		'narration' => 'required',
		'price' => 'required|numeric',
		'quantity' => 'required|numeric'
	);
	
}
