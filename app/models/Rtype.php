<?php

class Rtype extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'name' => 'required',
		'type' => 'required',		
	);
}
