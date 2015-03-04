@extends('layouts.scaffold')

@section('main')

<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <h1>Create User</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

{{ Form::open(array('route' => 'users.store', 'class' => 'form-horizontal')) }}

        <div class="form-group">
            {{ Form::label('email', 'Email:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::email('email', Input::old('email'), array('class'=>'form-control', 'placeholder'=>'Email')) }}
            </div>
        </div>

         <div class="form-group">
            {{ Form::label('username', 'Username:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('username', Input::old('username'), array('class'=>'form-control', 'placeholder'=>'Username')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('password', 'Password:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('password_comfirmation', 'Re-type Password:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::password('password_confirmation', array('class'=>'form-control', 'placeholder'=>'Re-type Password')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('role', 'User Role:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
                {{ Form::select('role', $roles, null, array('class'=>'form-control')) }}
            </div>
        </div>


        <div class="form-group">
            <label class="col-sm-2 control-label">&nbsp;</label>
            <div class="col-sm-10">
              {{ Form::submit('Create', array('class' => 'btn btn-lg btn-primary')) }}
            </div>
        </div>

{{ Form::close() }}

@stop


