@extends('masters.default_single')

@section('content')

<section>
<div class="row">

	<h1>{{trans('interface.pay_cc_title')}}</h1>

	<p>{{trans('interface.pay_cc_desc')}}</p>
	<p>
		<form action="{{url('complete_creditcard/'.$randomString)}}" method="POST">
			<script
			    src="https://checkout.stripe.com/v2/checkout.js" class="stripe-button"
			    data-key="{{Config::get('stripe.stripe.public')}}"
			    data-amount="{{ $amount }}"
			    data-currency="{{ $currency }}"
			    data-name="CryptoWaveCapital"
			    data-description="Mining Certificate Purchase"
			    data-image="/128x128.png">
			</script>
		</form>
	</p>

</div></section>

@stop
