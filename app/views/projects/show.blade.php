@extends('layouts.scaffold')

@section('main')

<div class="page-header">
	<h1 align="center">{{{$project->name}}} Project</h1>
	<p>&nbsp;</p>
</div>
	<div class="well">
		
			<h4>Start Date: {{{ $project->start }}}</h4>
		
		
			<h4>End Date: {{{ $project->end }}}</h4>
		
			<h4>Project Expense: &#8358;{{{ number_format(Expense::where('project_id', $project->name)->sum('amount')) }}}</h4>
			<h4>Project Revenue: &#8358;{{{ number_format(Revenue::where('project', $project->name)->sum('amount')) }}}</h4>
		
	</div>
	<div class="col-md-9">
		{{ link_to_route('projects.index', 'Return to All projects', null, array('class'=>'btn btn-primary')) }}
	@if(Auth::user()->role =='Admin')	
		{{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('projects.destroy', $project->id))) }}
		    {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
		{{ Form::close() }}
		{{ link_to_route('projects.edit', 'Edit', array($project->id), array('class' => 'btn btn-info')) }}
	@endif
		{{ link_to_route('expenses.create', 'New Expense', null, array('class' => 'btn btn-success')) }}
		{{ link_to_route('revenues.create', 'New Revenue', null, array('class' => 'btn btn-success')) }}


	</div>	
	<p>&nbsp;</p>
	<p>&nbsp;</p>
@if ($Expenses->count())
	<h2>Expenses</h2>
			<table class="table table-striped">
				<thead>
					<tr>					
						<th>Narration</th>						
						<th>Date</th>
						<th>Amount</th>
						<th>Action</th>
					</tr>
				</thead>

				<tbody>			
					@foreach ($Expenses as $Expense)
						<tr>						
							<td>{{{ $Expense->narration }}}</td>
							<td> {{{$Expense->transaction}}} </td>
							<td>&#8358;{{{ number_format((float)$Expense->amount) }}}</td>
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
<p>&nbsp;</p>
@if ($Revenues->count())
	<h2>Revenue</h2>
			<table class="table table-striped">
				<thead>
					<tr>					
						<th>Narration</th>
						<th>Date</th>
						<th>Amount</th>
						<th>Action</th>
					</tr>
				</thead>

				<tbody>			
					@foreach ($Revenues as $Revenue)
						<tr>						
							<td>{{{ $Revenue->narration }}}</td>
							<td>{{{ $Revenue->created_at }}}</td>							
							<td>&#8358;{{{ number_format((float)$Revenue->amount) }}}</td>
							<td>{{ link_to_route('revenues.show', 'View', $Revenue->id, array('class' => 'btn btn-success')) }}</td>					
						</tr>
					@endforeach								
				</tbody>
			</table>
			<p>{{ $Revenues->links()}}</p>	
		@else
		<p>&nbsp;</p>
		<p>There are no Revenue Items</p>
		<p>&nbsp;</p>
		@endif

@stop
