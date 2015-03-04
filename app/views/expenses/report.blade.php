@extends('layouts.scaffold')

@section('main')

<h1>All Expenses</h1>

{{ Form::open(array('style' => 'display: inline-block;', 'method' => 'POST', 'route' => array('report'))) }}  
    <div class="col-md-5">
      {{ Form::text('start', Input::old('start'), array('class'=>'form-control datepicker', 'placeholder'=>'Input Start Date', 'id' => 'datepicker')) }}           
    </div>
    <div class="col-md-5">
      {{ Form::text('start', Input::old('end'), array('class'=>'form-control datepicker', 'placeholder'=>'Input End Date', 'id' => 'datepicker')) }}           
    </div>
    <!-- /input-group -->	
    <div class="col-md-2">
    	{{ Form::submit('Generate', array('class' => 'btn btn-default')) }}
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
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>			
			@foreach ($Expenses as $Expense)
				<tr>
					<td>{{{ $Expense->type }}}</td>
					<td>{{{ $Expense->narration }}}</td>
					<td>{{{ number_format((float)$Expense->price) }}}</td>
					<td>{{{ number_format((float)$Expense->quantity) }}}</td>
					<td>{{{ number_format((float)$Expense->amount) }}}</td>					                    
				</tr>
			@endforeach
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td><strong>Total</strong></td>
				<td><strong>{{{number_format((float)$Expense->sum('amount'))}}}</strong></td>
				<td>&nbsp;</td>
			</tr>	
		</tbody>
	</table>
@else
	There are no Expenses
@endif

@stop
