@extends('layouts.scaffold')

@section('main')

<h1> User Profile</h1>

	<table class="table table-striped">
		<thead>
			<tr>
				<th>Username</th>
				<th>Email</th>
				<th>Role</th>
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>			
				<tr>
					<td>{{{ Auth::user()->username }}}</td>
					<td>{{{ Auth::user()->email }}}</td>
					<td>{{{ Auth::user()->role }}}</td>
                    <td>                        
						{{ link_to_route('account.edit', 'Change Password', null, array('class' => 'btn btn-primary')) }}</td>
				</tr>			
		</tbody>
	</table>

@stop
