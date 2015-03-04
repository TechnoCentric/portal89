<?php

class Project extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'name' => 'required',
		'start' => 'required',
		'end' => 'required'
	);
}
