@extends('layouts.scaffold')

@section('main')

<h1> Expense</h1>
<p>{{ link_to_route('expenses.index', 'Return to All Expenses', null, array('class'=>'btn btn-primary')) }}
</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Type</th>
				<th>Narration</th>
				<th>Price</th>
				<th>Quantity</th>
				<th>Amount</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $Expense->type }}}</td>
					<td>{{{ $Expense->narration }}}</td>
					<td>{{{ number_format($Expense->price) }}}</td>
					<td>{{{ number_format($Expense->quantity) }}}</td>
					<td>{{{ number_format($Expense->amount) }}}</td>
                    <td>
                	@if(Auth::user()->role =='Admin')
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('expenses.destroy', $Expense->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('expenses.edit', 'Edit', array($Expense->id), array('class' => 'btn btn-info')) }}
                    @endif
                    </td>
		</tr>
	</tbody>
</table>

@stop
