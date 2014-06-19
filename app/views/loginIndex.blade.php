@extends("masters.default")

@section('content')

	{{ Form::open(array('url' => 'login')) }}

		<h1>Login</h1>

		<ul>
	        @foreach($errors->all() as $error)
	            <li>{{ $error }}</li>
	        @endforeach
	    </ul>

	    <p>
	    	{{ Form::label('email', 'Email-address') }}
	    	{{ Form::text('email', null, array('placeholder' => 'info@youremail.com') )}}
	    </p>

	    <p>
	    	{{ Form::label('password', 'Password') }}
	    	{{ Form::password('password') }}
	    </p>

	    <p>
	    	{{ Form::hidden('intended', $intended) }}
	    	{{ Form::submit('Submit') }}
	    </p>

	{{ Form::close() }}

@stop