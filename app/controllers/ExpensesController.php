<?php

class ExpensesController extends BaseController {

	/**
	 * Expense Repository
	 *
	 * @var Expense
	 */
	protected $Expense;

	public function __construct(Expense $Expense)
	{
		$this->Expense = $Expense;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$categories = Etype::lists('name', 'type');
		$projects = DB::table('projects')->lists('name', 'type');
		$Expenses = $this->Expense->paginate(10);
		$etypes = Etype::all();

		return View::make('expenses.index', compact('Expenses', 'etypes', 'projects', 'categories'));
	}


	public function toExcel(){	
		$type = Input::get('type');
		$report_name = (string)Input::get('start').(string)Input::get('end');		

		if ($type == 0 ) {
				Excel::create( 'report'.$report_name, function($excel) {

		    		$excel->sheet('New sheet', function($sheet) {  

		    			$from = Input::get('start');
						$to   = Input::get('end');
						$project = Input::get('project');				

						$Expenses = Expense::whereBetween('transaction', array($from, $to))
											 ->where('project_id', 'LIKE', $project)									
											 ->get();				 
		        		$sheet->fromArray($Expenses);

		    		});

				})->download('xls');	

			}
		elseif ($type == 1) {
				Excel::create('report'.$report_name, function($excel) {

		    		$excel->sheet('New sheet', function($sheet) {  

		    			$from = Input::get('start');
						$to   = Input::get('end');
						$project = Input::get('project');				

						$Expenses = Revenue::whereBetween('created_at', array($from, $to))
											 ->where('project', 'LIKE', $project)									
											 ->get();				 
		        		$sheet->fromArray($Expenses);

		    		});

				})->download('xls');	

			}	
		
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$categories = Etype::lists('name', 'type');
		$projects = DB::table('projects')->lists('name', 'type');

		return View::make('expenses.create', compact('categories', 'projects'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//$input = Input::all();
		$expense = new Expense;		
		$expense->type = Input::get('type');
		$expense->project_id = Input::get('project');
		$expense->narration = Input::get('narration');
		$expense->price = Input::get('price');
		$expense->quantity = Input::get('quantity');
		$expense->transaction= Input::get('trx');
		$expense->creted_by= Auth::user()->username;	
		$expense->amount = float($expense->quantity * $expense->price);
		$validation = Validator::make(Input::all(), Expense::$rules);

		if ($validation->passes())
		{
			$expense->save();
			Flash::success('Expense Created');
			return Redirect::route('expenses.index');
		}

		return Redirect::route('expenses.create')
			->withInput()
			->withErrors($validation);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$Expense = $this->Expense->findOrFail($id);

		return View::make('expenses.show', compact('Expense'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if (Auth::user()->role == 'Admin'){	
			$Expense = $this->Expense->find($id);

			if (is_null($Expense))
			{
				return Redirect::route('expenses.index');
			}
			$categories = Etype::lists('name', 'type');
			return View::make('expenses.edit', compact('Expense', 'categories'));
		}
		Flash::error('Your account is not authorized to do this');
		return Redirect::back();	
	}
	/**
	 * Search Expenses.
	 *
	 * @param    $q
	 * @return Response
	 */
	public function search(){
		$categories = Etype::lists('name', 'type');
		$projects = DB::table('projects')->lists('name', 'type');
		$q = Input::get('search');
		$p = Input::get('project');
		$t = Input::get('type');
		$etypes = Etype::all();

		if ($q) {
			$Expenses = Expense::where('narration', 'LIKE' , "%$q%")->paginate(10);
			return View::make('expenses.index', compact('Expenses', 'etypes', 'projects', 'categories', 'q'));
		}
		else if ($t){
			$Expenses = Expense::where('type', 'LIKE', $t)->paginate(10);
			return View::make('expenses.index', compact('Expenses', 'etypes', 'projects', 'categories'));
		}
		else if ($p) {
			$Expenses = Expense::where('project_id', 'LIKE', $p)->paginate(10);
			return View::make('expenses.index', compact('Expenses', 'etypes', 'projects', 'categories'));
		}		
		else return View::make('expenses.index', compact('Expenses', 'etypes', 'projects', 'categories'));		
	}
	public function getReport(){
		
		$categories = Etype::lists('name', 'type');
		$projects = DB::table('projects')->lists('name', 'type');
		return View::make('report', compact('Expenses', 'projects', 'categories'));
	}

	public function postReport(){
		$from = Input::get('start');
		$to   = Input::get('end');
		$project = Input::get('project');
		$type = Input::get('report');
		

		
		if($type == 0){
			$Expenses = Expense::whereBetween('transaction', array($from, $to))
								->where('project_id', 'LIKE', $project)
								->get();							 
			return View::make('results', compact('Expenses', 'from', 'to', 'project', 'type'));
		}
		elseif ($type == 1) {
			# code...
			$Expenses = Revenue::whereBetween('created_at', array($from, $to))
								->where('project', 'LIKE', $project)
								->get();							 
			return View::make('results', compact('Expenses', 'from', 'to', 'project', 'type'));
		}
		else Flash::error('Please select a report type');
		return Redirect::back();
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if (Auth::user()->role == 'Admin'){
			$input = array_except(Input::all(), '_method');
			$validation = Validator::make($input, Expense::$rules);

			if ($validation->passes())
			{
				$Expense = $this->Expense->find($id);
				$quantity = Input::get('quantity');
				$price  = Input::get('price');
				$amount = $quantity * $price ;
				$Expense->update($input, $amount);

				return Redirect::route('expenses.show', $id);
			}

			return Redirect::route('expenses.edit', $id)
				->withInput()
				->withErrors($validation);
		}
		Flash::error('Your account is not authorized to do this');
		return Redirect::back();	
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if (Auth::user()->role == 'Admin'){
			$this->Expense->find($id)->delete();
			Flash::success('Project Deleted');
			return Redirect::route('expenses.index');
		}	
		Flash::error('Your account is not authorized to do this');
		return Redirect::back();	
	}

}
