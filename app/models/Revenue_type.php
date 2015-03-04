<?php

class Revenue_type extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'name' => 'required',
		'type' => 'required',		
	);
}
