<?php namespace Dexter\Presenters;

use Laracasts\Presenter\Presenter;

class Expense extends Presenter {
	
	

	puplic numberFormat(Expense $this){
		return number_format($this);
	}

}