@extends('layouts.scaffold')

@section('main')

	<h1>All Expenses</h1>			
	<div class="well">		
		{{ Form::open(array( 'id' => 'selectProject', 'class' => 'form-inline', 'method' => 'POST', 'route' => array('expenses.search'))) }}
			 <div class="col-md-3">  
		    	{{ Form::select('project', array('-1' => 'Select Project') + $projects, null, array('class'=>'form-control' )) }}	    	
		    </div>
		{{Form::close()}}

		{{ Form::open(array( 'id' => 'selectType', 'class' => 'form-inline', 'method' => 'POST', 'route' => array('expenses.search'))) }}    			
		    <div class="col-md-3">
		    	{{ Form::select('type', array('-1' => 'Select Type') + $categories, null, array('class'=>'form-control')) }}                    
		    </div>
		    <div class="col-md-3">{{ Form::submit('Filter', array('class' => 'btn btn-success')) }}</div>
		{{ Form::close() }}	
			<div class="col-md-3">{{ link_to_route('expenses.create', 'Create', null, array('class' => 'btn btn-success')) }}</div>			
	</div>      
		@if ($Expenses->count())
			<table class="table table-striped">
				<thead>
					<tr>					
						<th>Narration</th>
						<th>Project</th>
						<th>Date</th>
						<th>Amount</th>
						<th>Action</th>
					</tr>
				</thead>

				<tbody>			
					@foreach ($Expenses as $Expense)
						<tr>						
							<td>{{{ $Expense->narration }}}</td>
							<td>{{{ $Expense->project_id}}}</td>
							<td>{{{ $Expense->transaction }}}</td>
							<td> &#8358;{{{ number_format((float)$Expense->amount) }}}</td>
							<td>{{ link_to_route('expenses.show', 'View', $Expense->id, array('class' => 'btn btn-success')) }}</td>					
						</tr>
					@endforeach								
				</tbody>
			</table>
			<p>{{ $Expenses->links()}}</p>	
		@else
		<p>&nbsp;</p>
		<p>There are no Expenses</p>
		<p>&nbsp;</p>
		@endif
		{{ Form::open(array('style' => 'display: inline-block;', 'method' => 'POST', 'route' => array('download'))) }}      
      		{{ Form::hidden('project', $p)}}
      		{{ Form::hidden('type', $t)}}      
    <div class="col-md-4">
    		{{ Form::submit('Download', array('class' => 'btn btn-success')) }}
    </div>    
		{{ Form::close() }}
		 <script type="text/javascript">
	            	function myType() {
						document.getElementById("selectType").submit();
					}
					function myProject() {
						document.getElementById("selectProject").submit();
					}
        </script>       

@stop
