@extends('layouts.scaffold')

@section('main')

<h1 align="center">All Projects</h1>
<p>&nbsp;</p>
<p>{{ link_to_route('projects.create', 'Create Project', null, array('class' => 'btn btn-lg btn-success')) }}</p>

@if ($projects->count())
	<table class="table table-striped">
		<thead>
			<tr>
	          <th>Name</th>
	          <th>Start Date</th>
	          <th>Project Expense</th>
	           <th>Project Revenue</th>
	          <th>Action</th>          
	        </tr>
	      </thead>

	      <tbody>
	        @foreach ($projects as $project)
	          <tr>
	            <td>{{{ $project->name }}}</td>
	            <td> {{{$project->start}}} </td>
	            <td>&#8358;{{{ number_format(Expense::where('project_id', $project->name)->sum('amount')) }}}</td>
	            <td>&#8358;{{{ number_format(Revenue::where('project', $project->name)->sum('amount')) }}}</td>
	            <td>{{ link_to_route('projects.show', 'View', array($project->id), array('class' => 'btn btn-success')) }}</td>                      
	          </tr>
			@endforeach
		</tbody>
	</table>
	<p> {{$projects->links()}} </p>
@else
	There are no projects
@endif

@stop
