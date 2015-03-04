@extends('layouts.scaffold')

@section('main')
@if($type == 0)
	<h1>Expenses Report</h1>
@elseif($type== 1)
	<h1>Revenue Report</h1>
@endif
<p>&nbsp;</p>

@if ($Expenses->count())
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Type</th>
				<th>Narration</th>				
				<th>Amount</th>
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>			
			@foreach ($Expenses as $Expense)
				<tr>
					<td>{{{ $Expense->type }}}</td>
					<td>{{{ $Expense->narration }}}</td>					
					<td>{{{ number_format((float)$Expense->amount, 2) }}}</td>					
                    <td>                                            
                        {{ link_to_route('expenses.show', 'View', array($Expense->id), array('class' => 'btn btn-success')) }}
                    </td>
				</tr>
			@endforeach			
		</tbody>
	</table>
	<p></p>		
	<p>&nbsp;</p>
	{{ Form::open(array('style' => 'display: inline-block;', 'method' => 'POST', 'route' => array('excel'))) }}      
      {{ Form::hidden('start', $from)}}
      {{ Form::hidden('end', $to)}}
      {{ Form::hidden('project', $project) }} 
      {{ Form::hidden('type', $type) }}   	 
    <div class="col-md-4">
    	{{ Form::submit('Download', array('class' => 'btn btn-success')) }}
    </div>
    <div class="col-md-6">
    	{{ link_to_route('report', 'Back to Reports',  null, array('class' => 'btn btn-success')) }}
    </div>
{{ Form::close() }}
@else
	<p>&nbsp;</p>
	There are no Expenses
@endif

@stop
