@extends('layouts.scaffold')

@section('main')

<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <h1>Create Expense</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

{{ Form::open(array('route' => 'expenses.store', 'class' => 'form-horizontal')) }}

        <div class="form-group">
            {{ Form::label('project', 'Project:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">                
              {{ Form::select('project', $projects, null, array('class'=>'form-control', 'placeholder'=>'Project')) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('type', 'Type:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">                
              {{ Form::select('type', $categories, null, array('class'=>'form-control', 'placeholder'=>'Type')) }}
            </div>
        </div>        

        <div class="form-group">
            {{ Form::label('narration', 'Narration:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('narration', Input::old('narration'), array('class'=>'form-control', 'placeholder'=>'Narration')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('price', 'Price:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::input('number', 'price', Input::old('price'), array('class'=>'form-control')) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('quantity', 'Quantity:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::input('number', 'quantity', Input::old('quantity'), array('class'=>'form-control')) }}
              
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('trx', 'Transaction Date:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('trx', Input::old('trx'), array('class'=>'form-control datepicker', 'placeholder'=>'Select Transaction Date', 'id' => 'datepicker')) }}
              
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">&nbsp;</label>
            <div class="col-sm-10">
            {{ Form::submit('Create', array('class' => 'btn btn-lg btn-primary')) }}  
            {{ link_to_route('expenses.index', 'Cancel', null, array('class' => 'btn btn-lg btn-danger')) }}    
            </div>    
        </div>


{{ Form::close() }}

@stop


