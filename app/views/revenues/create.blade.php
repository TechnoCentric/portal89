@extends('layouts.scaffold')

@section('main')

<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <h1>Create Revenue</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

{{ Form::open(array('route' => 'revenues.store', 'class' => 'form-horizontal')) }}

        <div class="form-group">
            {{ Form::label('project', 'Project:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">                
              {{ Form::select('project', array('-1' => 'Select Project') + $projects, null, array('class'=>'form-control' )) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('type', 'Type:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">                
              {{ Form::select('type', array('-1' => 'Select Type') + $categories, null, array('class'=>'form-control' )) }}
            </div>
        </div>  

        <div class="form-group">
            {{ Form::label('narration', 'Narration:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('narration', Input::old('narration'), array('class'=>'form-control', 'placeholder'=>'Narration')) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('amount', 'Amount:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::input('number', 'amount', Input::old('amount'), array('class'=>'form-control')) }}
              
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


