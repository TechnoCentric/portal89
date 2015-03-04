@extends('layouts.scaffold')

@section('main')

<h1>All Expenses</h1>
{{ Form::open(array('style' => 'display: inline-block;', 'method' => 'POST', 'route' => array('expenses.search'))) }}  
    <div class="col-md-10">
      {{ Form::text('search', Input::old('start'), array('class'=>'form-control', 'placeholder'=>'Search Expenses')) }}           
    </div><!-- /input-group -->	
    <div class="col-md-2">
    	{{ Form::submit('Search', array('class' => 'btn btn-default')) }}
    </div>
{{ Form::close() }}

@if ($Expenses->count())
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Type</th>
				<th>Narration</th>
				<th>Price</th>
				<th>Quantity</th>
				<th>Amount</th>
				<th>Action</th>
			</tr>
		</thead>

		<tbody>			
			@foreach ($Expenses as $Expense)
				<tr>
					<td>{{{ $Expense->type }}}</td>
					<td>{{{ $Expense->narration }}}</td>
					<td>{{{ $Expense->price }}}</td>
					<td>{{{ $Expense->quantity }}}</td>
					<td>{{{ $Expense->amount }}}</td>					
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('expenses.destroy', $Expense->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('expenses.edit', 'Edit', array($Expense->id), array('class' => 'btn btn-info')) }}
                    </td>
				</tr>
			@endforeach
			<tr>
				<td></td>
				<td>&nbsp;</td>
				<td></td>
				<td><strong>Total</strong></td>
				<td><strong>{{{$Expense->sum('amount')}}}</strong></td>
				<td>&nbsp;</td>
			</tr>	
		</tbody>
	</table>
	<p> {{$Expenses->links()}} </p>
	<p>&nbsp;</p>
	{{ link_to_route('expenses.create', 'Add New Expense', null, array('class' => 'btn btn-lg btn-success')) }}
	{{ link_to_route('etypes.index', 'Return to Overview', null, array('class' => 'btn btn-lg btn-success')) }}
@else
	There are no Expenses
@endif

@stop
\