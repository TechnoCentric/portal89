@extends('layouts.scaffold')

@section('main')

<h1>Expenses Overview</h1>


@if ($etypes->count())
	<table class="table">
		<thead>
			<tr>
				<th>Name</th>
				<th>Amount</th>
				<th>Action</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($etypes as $etype)						
				<tr>
					<td>{{{ $etype->name}}}</td>
					<td> &#8358;{{{ number_format(Expense::where('type', $etype->name)->sum('amount')) }}} </td>
                	<td>@if(Auth::user()->role == 'Admin')
                    		{{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('etypes.destroy', $etype->id))) }}
                        		{{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                    		{{ Form::close() }}
                    		{{ link_to_route('etypes.edit', 'Edit', array($etype->id), array('class' => 'btn btn-info')) }}
                		@endif
                	</td>
				</tr>			
			@endforeach			
		</tbody>
	</table>
	<p> {{$etypes->links()}} </p>
	<p>&nbsp;</p>
	{{ link_to_route('etypes.create', 'Add New Type', null, array('class' => 'btn btn-lg btn-success')) }}
	{{ link_to_route('expenses.index', 'View All Expenses', null, array('class' => 'btn btn-lg btn-success')) }}					
	
@else
	<p>There are no Expense Types</p>
	<p>{{ link_to_route('etypes.create', 'Add New Type', null, array('class' => 'btn btn-lg btn-success')) }}</p>
@endif

@stop
