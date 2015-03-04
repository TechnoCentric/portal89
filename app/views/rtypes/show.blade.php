@extends('layouts.scaffold')

@section('main')

<h1>Showing {{{ $rtype->name }}} Revenue </h1>

<p>{{ link_to_route('rtypes.index', 'Back', null, array('class'=>'btn btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
				<th>Type</th>
				<th>Creator</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $rtype->name }}}</td>
					<td>{{{ $rtype->type }}}</td>
					<td>{{{ $rtype->creator }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('rtypes.destroy', $rtype->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('rtypes.edit', 'Edit', array($rtype->id), array('class' => 'btn btn-info')) }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
