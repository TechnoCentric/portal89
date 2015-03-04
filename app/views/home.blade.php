@extends('layouts.scaffold')

@section('main')
<div class="jumbotron">
  <div class="col-md-6"><img src="assets/img/login-logo.png" alt="Logo"></div>  
</div>
  <h2 align="center">Projects</h2>
  @if ($projects->count())
    <table class="table">
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
    {{ link_to_route('projects.create', 'Create Project', null, array('class' => 'btn btn-success')) }}
    {{ link_to_route('projects.index', 'View all', null, array('class' => 'btn btn-success')) }}     
  @else
    There are no projects
  @endif  
@stop