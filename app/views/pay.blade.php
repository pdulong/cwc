@extends('masters.default_single')

@section('content')

<section>
<div class="row">

	<h1>{{trans('interface.information')}}</h1>

	@if(Session::has('alertMessage') || isset($alertMessage))
		<div class="message error"><p>{{ (isset($alertMessage)?$alertMessage:Session::get('alertMessage')) }}</p></div>
	@endif

	@if(Session::has('infoMessage') || isset($infoMessage))
		<div class="message info"><p>{{ (isset($infoMessage)?$infoMessage:Session::get('infoMessage')) }}</p></div>
	@endif

	@if(Session::has('successMessage') || isset($successMessage))
		<div class="message success"><p>{{ (isset($successMessage)?$successMessage:Session::get('successMessage')) }}</p></div>
	@endif

	{{ link_to('orders/buy', trans('interface.form_retryOrder')) }}

</div></section>

@stop
