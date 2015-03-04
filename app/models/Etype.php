<?php

class Etype extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'name' => 'required'
	);
	public function Expenses(){
		return $this->belongsToMany('Expense');
	}	
}	
