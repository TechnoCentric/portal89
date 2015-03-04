@extends('layouts.scaffold')

@section('main')

    <h1>Reports Generation</h1>
    <p>&nbsp;</p>
    <div class="well">
    {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'POST', 'route' => array('results'))) }}  
        <div class="col-md-3">
          {{ Form::text('start', Input::old('start'), array('class'=>'form-control datepicker', 'placeholder'=>'Input Start Date', 'id' => 'datepicker1')) }}           
        </div>
        <div class="col-md-3">
          {{ Form::text('end', Input::old('end'), array('class'=>'form-control datepicker', 'placeholder'=>'Input End Date', 'id' => 'datepicker2')) }}           
        </div>    
        <div class="col-md-3">  
            {{ Form::select('project', array('-1' => 'Select Project') + $projects, null, array('class'=>'form-control')) }}         
        </div>            
        <!-- /input-group -->	
        <div class="col-md-3">
        	{{ Form::submit('Generate', array('class' => 'btn btn-success')) }}
        </div> 
        <p>&nbsp;</p> 
        <div class="col-md-3">  
            {{ Form::select('report', array('-1' => 'Report Type', '0' => 'Expenses', '1' => 'Revenue'), null, array('class'=>'form-control')) }}         
        </div>   
    {{ Form::close() }}
    </div>
@stop
