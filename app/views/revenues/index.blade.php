@extends('layouts.scaffold')

@section('main')

<h1>Revenues</h1>

<p>{{ link_to_route('revenues.create', 'Add Revenue', null, array('class' => 'btn btn-success')) }}</p>

@if ($revenues->count())
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Narration</th>
				<th>Type</th>
				<th>Project</th>
				<th>Amount</th>
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($revenues as $revenue)
				<tr>
					<td>{{{ $revenue->narration }}}</td>
					<td>{{{ $revenue->type }}}</td>
					<td>{{{ $revenue->project }}}</td>
					<td> &#8358;{{{ number_format($revenue->amount) }}}</td>
                    <td>@if(Auth::user()->role == 'Admin')
                        	{{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('revenues.destroy', $revenue->id))) }}
                            	{{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        	{{ Form::close() }}
                        	{{ link_to_route('revenues.edit', 'Edit', array($revenue->id), array('class' => 'btn btn-info')) }}
                    	@endif
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no revenues
@endif

@stop
