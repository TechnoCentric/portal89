<?php

class Revenue extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'project' => 'required',
		'type' => 'required',
		'narration' => 'required',
		'amount' => 'required | numeric',		
	);
}
