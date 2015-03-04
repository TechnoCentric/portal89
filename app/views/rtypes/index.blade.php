@extends('layouts.scaffold')

@section('main')

<h1>Revenue Types</h1>

<p>{{ link_to_route('rtypes.create', 'Add New Type', null, array('class' => 'btn btn-success')) }}</p>

@if ($rtypes->count())
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Name</th>
				<th>Type</th>
				<th>Creator</th>
				<th>Amount</th>
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($rtypes as $rtype)
				<tr>
					<td>{{{ $rtype->name }}}</td>
					<td>{{{ $rtype->type }}}</td>
					<td>{{{ $rtype->creator }}}</td>
					<td>&#8358;{{{ number_format(Revenue::where('type', $rtype->name)->sum('amount')) }}}</td>
                    <td>                       
                        {{ link_to_route('rtypes.show', 'view', array($rtype->id), array('class' => 'btn btn-success')) }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no rtypes
@endif

@stop
