@extends('layouts.scaffold')

@section('main')

<h1>Show Revenue</h1>

<p>{{ link_to_route('revenues.index', 'Return to All revenues', null, array('class'=>'btn btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Project</th>
				<th>Type</th>
				<th>Narration</th>
				<th>Amount</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $revenue->project }}}</td>
					<td>{{{ $revenue->type }}}</td>
					<td>{{{ $revenue->narration }}}</td>
					<td>&#8358;{{{ number_format($revenue->amount) }}}</td>
                    <td>
                    @if(Auth::user()->role =='Admin')
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('revenues.destroy', $revenue->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('revenues.edit', 'Edit', array($revenue->id), array('class' => 'btn btn-info')) }}
                    @endif
                    </td>
		</tr>
	</tbody>
</table>

@stop
