@extends('layouts.scaffold')

@section('main')

<h1>All Users</h1>

<p>{{ link_to_route('users.create', 'Add New User', null, array('class' => 'btn btn-lg btn-success')) }}</p>

@if ($Users->count())
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Username</th>
				<th>Password</th>
				<th>Role</th>
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($Users as $User)
				<tr>
					<td>{{{ $User->username }}}</td>
					<td>{{{ $User->email }}}</td>
					<td>{{{ $User->role }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('users.destroy', $User->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                        {{ link_to_route('users.edit', 'Edit', array($User->id), array('class' => 'btn btn-info')) }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<p> {{$Users->links()}} </p>
@else
	There are no Users
@endif

@stop
