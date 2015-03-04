@extends('layouts.scaffold')

@section('main')

	<h1>All Expenses</h1>
	<p>{{ link_to_route('expenses.create', 'Add Expense', null, array('class' => 'btn btn-success')) }}</p>	   		
	<div class="well">
		{{ Form::open(array( 'id' => 'searchForm', 'class' => 'form-inline', 'method' => 'POST', 'route' => array('expenses.search'))) }}  
		    <div class="col-md-4">
		      {{ Form::text('search', Input::old('start'), array('class'=>'form-control', 'placeholder'=>'Search')) }}           
		    </div><!-- /input-group -->	   
		{{Form::close()}}

		{{ Form::open(array( 'id' => 'selectProject', 'class' => 'form-inline', 'method' => 'POST', 'route' => array('expenses.search'))) }}
			 <div class="col-md-3">  
		    	{{ Form::select('menus[]', $projects, null, array('multiple' => true,'class' => 'form-control'))}}	    	
		    </div>
		{{Form::close()}}

		{{ Form::open(array( 'id' => 'selectType', 'class' => 'form-inline', 'method' => 'POST', 'route' => array('expenses.search'))) }}    			
		    <div class="col-md-3">
		    	{{ Form::select('type', array('-1' => 'Select Type') + $categories, null, array('class'=>'form-control')) }}                    
		    </div>
		    {{ Form::submit('Generate', array('class' => 'btn btn-success')) }}
		{{ Form::close() }}
		<p>&nbsp;</p>	
		<p>&nbsp;</p>		
		<p><strong>Hint: press and hold the Ctrl key and click to select more than one project</strong></p>	
	</div>

		@if ($Expenses->count())
			<table class="table table-striped">
				<thead>
					<tr>					
						<th>Narration</th>
						<th>Project</th>
						<th>Date</th>
						<th>Amount</th>
						<th></th>
					</tr>
				</thead>

				<tbody>			
					@foreach ($Expenses as $Expense)
						<tr>						
							<td>{{{ $Expense->narration }}}</td>
							<td>{{{ $Expense->project_id}}}</td>
							<td>{{{ $Expense->transaction }}}</td>
							<td> &#8358;{{{ number_format((float)$Expense->amount) }}}</td>
							<td>@if(Auth::user()->role == 'Admin')
                        			{{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('expenses.destroy', $Expense->id))) }}
                            			{{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        			{{ Form::close() }}
                        			{{ link_to_route('expenses.edit', 'Edit', array($Expense->id), array('class' => 'btn btn-info')) }}
                    			@endif</td>					
						</tr>
					@endforeach	
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td><strong>Total:</strong></td>
					<td><strong>&#8358;{{number_format($Expenses->sum('amount'))}}</strong></td>
					<td></td>							
				</tbody>
			</table>
			{{ $Expenses->links()}}							
		@else
		<p>&nbsp;</p>
		<p>There are no Expenses</p>
		<p>&nbsp;</p>
		@endif

		 <script type="text/javascript">
	            	function myType() {
						document.getElementById("selectType").submit();
					}
					function myProject() {
						document.getElementById("selectProject").submit();
					}
        </script>       

@stop
