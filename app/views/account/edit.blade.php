@extends('layouts.scaffold')

@section('main')

<div class="row">
    <div class="col-md-10">
        <h1>Change Password</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

{{ Form::open(array('class' => 'form-horizontal', 'method' => 'POST', 'route' => array('account.edit'))) }}        

        <div class="form-group">			
			<div class="col-sm-8">				
				{{ Form::password('password', array ('class' => 'form-control', 'placeholder' => 'New Password')) }}
			</div>
		</div>

        <div class="form-group">			
			<div class="col-sm-8">				
				{{ Form::password('password_confirmation', array ('class' => 'form-control', 'placeholder' => 'Re-type Password')) }}
			</div>
		</div>

		<div class="form-group">    
		    <div class="col-sm-10">
		      {{ Form::submit('Change ', array('class' => 'btn  btn-primary')) }}
		      {{ link_to_route('account.dashboard', 'Cancel', null, array('class' => 'btn btn-danger')) }}
		    </div>
		</div>

{{ Form::close() }}

@stop