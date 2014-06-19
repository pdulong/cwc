@extends('masters.default')

@section('content')

{{ Form::open(array('url'=>'orders/buy/' . $productActive)) }}
    <h2>Please Register</h2>

    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>

    <h3>Product</h3>

    {{ Form::label('amount', 'Amount') }}
    {{ Form::text('amount', '1', array('size' => 2 ))}}

    {{ Form::select('product', $products, $productActive) }}

	@if( !Auth::check() )
	    <h3>Personal data</h3>

	    <p>Already an account: <a href="{{ URL::to('login', array('intended' => $productActive ))}}">Login</a></p>

	    {{ Form::text('firstname', null, array('class'=>'input-block-level', 'placeholder'=>'First Name')) }}
	    {{ Form::text('lastname', null, array('class'=>'input-block-level', 'placeholder'=>'Last Name')) }}
	    {{ Form::text('email', null, array('class'=>'input-block-level', 'placeholder'=>'Email Address')) }}
	    {{ Form::password('password', array('class'=>'input-block-level', 'placeholder'=>'Password')) }}
	    {{ Form::password('password_confirmation', array('class'=>'input-block-level', 'placeholder'=>'Confirm Password')) }}

	    <h4>Address</h4>
	    {{ Form::text('telephone', null, array('placeholder' => 'Telephone')) }}
	    {{ Form::text('address', null, array('placeholder' => 'Address')) }}
	    {{ Form::text('postal', null, array('placeholder' => 'Postal')) }}
	    {{ Form::select('country', $countries) }}

	@else
		<p>Logged in as {{ Auth::user()->email }} (<a href="{{ URL::to('logout') }}">Log-out</a>)
	@endif

    <h3>Payment method</h3>
    {{ Form::select('payment', array('ideal' => 'IDEAL', 'creditcard'=>'Creditcard') ) }}

    <h3>Confirm</h3>
    {{ Form::checkbox('av', 'av') }}

    {{ Form::submit('Register', array('class'=>'btn btn-large btn-primary btn-block'))}}
{{ Form::close() }}

@stop