@extends('layout.main')

@section('content')
	<form  action ="{{ URL::route('account-change-password') }}" method="post">
		<div class="field">
			Old password: <input type="password" name="old_password"> 
		</div>
		<div class="field">
			New Password: <input type="password" name="password">
		</div>
		<div class="field">
			New Password: <input type="password" name="password_again">
		</div>
		<input type="submit" value="Change Password">
		{{ Form::token() }}
	</form>