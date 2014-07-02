@extends('masters.default_single')

@section('content')

<section>
<div class="row">


	{{ Form::open(array('url' => 'login')) }}

		<h1>{{trans('interface.login')}}</h1>

		<p>{{trans('interface.login_desc')}}</p>

		<ul>
	        @foreach($errors->all() as $error)
	            <li>{{ $error }}</li>
	        @endforeach
	    </ul>

		<div class="fieldRow">
			{{ Form::label('email', trans('interface.form_email')) }}
	    	{{ Form::text('email', null, array('placeholder' => trans('interface.form_email')) )}}
	    </div>

	    <div class="fieldRow">
	    	{{ Form::label('password', trans('interface.form_password')) }}
	    	{{ Form::password('password') }}
	    </div>

	    <div class="fieldRow">
	    	{{ Form::hidden('intended', $intended) }}
	    </div>
	    	{{ Form::submit(trans('interface.login'), array('id' => 'submit')) }}

	{{ Form::close() }}

</div></section>

@stop
