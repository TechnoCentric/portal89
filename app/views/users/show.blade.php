@extends('layouts.scaffold')

@section('main')

<h1>Show User</h1>

<p>{{ link_to_route('users.index', 'Return to All Users', null, array('class'=>'btn btn-lg btn-primary')) }}</p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Username</th>
				<th>Password</th>
				<th>Role</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $User->username }}}</td>
					<td>{{{ $User->password }}}</td>
					<td>{{{ $User->role }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('users.destroy', $User->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('users.edit', 'Edit', array($User->id), array('class' => 'btn btn-info')) }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
