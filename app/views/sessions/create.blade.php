@extends('layouts.logintemp')

@section('content')			
        <div class="full-content-center">
			<p class="text-center"><a href="http://www.technocentric.net"><img src="assets/img/login-logo.png" alt="Logo"></a></p>
			<div class="login-wrap animated flipInX">				
				<div class="login-block">					
					<img src="images/users/user60.png" class="img-circle not-logged-avatar">
					@if (Session::has('flash_notification.message'))
                        <div class="alert alert-{{ Session::get('flash_notification.level') }}">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                                {{ Session::get('flash_notification.message') }}
                        </div>
                    @endif
					@if ($errors->any())
			        	<div class="alert alert-danger">
			        	    <ul>
			                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
			                </ul>
			        	</div>
			        @endif	
					{{ Form::open(array('route' => 'login_path', 'class' => 'form-horizontal')) }}
						<div class="form-group login-input">						
						{{ Form::text('username', null, array('class' => 'form-control', 'placeholder' => 'Username')) }}
						</div>
						<div class="form-group login-input">
						{{ Form::password('password', array ('class' => 'form-control', 'placeholder' => 'Password')) }}
						</div>
						
						<div class="row">
							<div class="col-sm-6">
							{{ Form::submit('LOGIN', array('class' => 'btn btn-primary')) }}
							</div>							
						</div>
					{{ Form::close() }}
				</div>
			</div>
			
		</div>		

@stop