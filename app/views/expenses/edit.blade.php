@extends('layouts.scaffold')

@section('main')

<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <h1>Edit Expense</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

{{ Form::model($Expense, array('class' => 'form-horizontal', 'method' => 'PATCH', 'route' => array('expenses.update', $Expense->id))) }}

        <div class="form-group">
            {{ Form::label('type', 'Type:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::select('type', array('-1' => 'Select Type') + $categories, null, array('class'=>'form-control' )) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('narration', 'Narration:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::textarea('narration', Input::old('narration'), array('class'=>'form-control', 'placeholder'=>'Narration')) }}
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
    <label class="col-sm-2 control-label">&nbsp;</label>
    <div class="col-sm-10">
      {{ Form::submit('Update', array('class' => 'btn btn-lg btn-primary')) }}
      {{ link_to_route('expenses.show', 'Cancel', $Expense->id, array('class' => 'btn btn-lg btn-default')) }}
    </div>
</div>

{{ Form::close() }}

@stop