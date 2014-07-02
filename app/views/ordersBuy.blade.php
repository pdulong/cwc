@extends('masters.default_single')

@section('content')

<script type="text/javascript">
$( document ).ready(function() {
	$("#productSelect tr td").click(function(){

		$('input[name=product]').prop('checked',false);
		$("#productSelect tr.favorite").removeClass('favorite');
		$(this).parent().addClass('favorite').find('input[name=product]').prop('checked',true);
	});
});
</script>

<section>
<div class="row">

{{ Form::open(array('url'=>'orders/buy/' . $productActive)) }}
    <h1>{{trans('interface.buy_title')}}.</h1>
    <p>{{trans('interface.buy_description')}}</p>

	@if(Session::has('alertMessage'))
		<div class="message error"><p>{{ Session::get('alertMessage') }}</p></div>
	@endif

    @foreach($errors->all() as $error)
        <div class="message error"><p>{{ $error }}</p></div>
    @endforeach



    <h2>{{trans('interface.buy_title_overview')}}</h2>

    <table cellspacing="0" id="productSelect">
    	<thead>
    		<tr>
    			<th> </th>
    			<th colspan="2">{{trans('interface.buy_product')}}</th>
				<th>{{trans('interface.buy_total')}}</th>
    		</tr>
    	</thead>
    	<tbody>
    	@foreach( $products as $index => $product )
			<tr class="@if($index % 2) odd @elseif($productActive == $product -> id) favorite @endif">
	    		<td><input type="radio" value="{{ $product -> id }}" name="product" @if($productActive == $product -> id) checked="checked" @endif></td>
	    		<td>{{ trans('interface.productName_'.$product -> nameSlug) }}</td> <td>{{ $product -> hash }} {{trans('interface.buy_certificate')}}{{ ($product -> hash==1)?'':'s' }} x &euro; {{ Product::formatCurrency($product -> price_per_hash) }}</td>
	    		<td>&euro; {{ Product::formatCurrency($product -> price_per_hash*$product ->hash) }}</td>
	    	</tr>
    	@endforeach
    	</tbody>
    	<tfoot>
    		<tr>
    			<th> </th>
    			<th class="alignRight"></th>
				<th> </th>
    		</tr>
    	</tfoot>
    </table>

    {{ Form::hidden('amount', '1')}}

    <h2 class="paddingAbove">{{trans('interface.buy_personal_info')}}</h2>

	@if( !Auth::check() )

	    <div class="message info"><p>{{trans('interface.buy_boughtBefore')}} <a href="{{ URL::to('login', array('intended' => $productActive ))}}">{{trans('interface.buy_login')}}</a></p></div>

		<div class="fieldRow">
			{{ Form::label('firstname', trans('interface.form_firstName')); }}
			{{ Form::text('firstname', null, array('class'=>'input-block-level', 'placeholder'=> trans('interface.form_firstName'))) }}
		</div>

		<div class="fieldRow">
			{{ Form::label('lastname', trans('interface.form_lastName')); }}
		    {{ Form::text('lastname', null, array('class'=>'input-block-level', 'placeholder'=> trans('interface.form_lastName'))) }}
		</div>

	    <div class="fieldRow">
			{{ Form::label('email', trans('interface.form_email')); }}
		    {{ Form::text('email', null, array('class'=>'input-block-level', 'placeholder'=> trans('interface.form_email'))) }}
	    </div>

	    <div class="fieldRow">
			{{ Form::label('password', trans('interface.form_password')); }}
		    {{ Form::password('password', array('class'=>'input-block-level', 'placeholder'=> trans('interface.form_password'))) }}
	    </div>

	    <div class="fieldRow">
			{{ Form::label('password_confirmation', trans('interface.form_passwordRepeat')); }}
		    {{ Form::password('password_confirmation', array('class'=>'input-block-level', 'placeholder'=> trans('interface.form_passwordRepeat'))) }}
	    </div>

		<div class="clear"></div>

	    <h4>{{trans('interface.buy_addressData')}}</h4>

		<div class="fieldRow">
			{{ Form::label('address', trans('interface.form_address')); }}
		    {{ Form::text('address', null, array('placeholder' => trans('interface.form_address'), 'class'=>'large')) }}
		</div>

	    <div class="fieldRow">
			{{ Form::label('postal', trans('interface.form_postal')); }}
		    {{ Form::text('postal', null, array('placeholder' => trans('interface.form_postal'))) }}
	    </div>

	    <div class="fieldRow">
			{{ Form::label('country', trans('interface.form_country')); }}
		    {{ Form::select('country', $countries) }}
	    </div>

	     <div class="fieldRow">
			{{ Form::label('telephone', trans('interface.form_telephone')); }}
		    {{ Form::text('telephone', null, array('placeholder' => trans('interface.form_telephone'))) }}
	    </div>

	    <div class="clear"></div>
	@else
		<div class="message info"><p>{{trans('interface.buy_loggedInAs')}} {{ Auth::user()->email }} (<a href="{{ URL::to('logout') }}">{{trans('interface.logout')}}</a>)</p></div>
	@endif

    <h2 class="paddingAbove">{{trans('interface.buy_paymentMethod')}}</h2>

    <div class="fieldRow">
		{{ Form::label('payment', trans('interface.buy_paymentMethod')); }}
	    {{ Form::select('payment', array('ideal' => trans('interface.form_ideal'), 'creditcard'=>trans('interface.form_cc')) ) }}
    </div>

    <h2 class="paddingAbove">{{trans('interface.buy_tc')}}</h2>
    <p>{{trans('interface.buy_tcDesc')}} <a href="#">{{strtolower(trans('interface.buy_tc'))}}</a></p>
    {{ Form::checkbox('av', 'av') }} {{trans('interface.buy_tcAccept')}}

    <p>{{ Form::submit(trans('interface.form_order'), array('class'=>'', 'id' => 'submit'))}}</p>
{{ Form::close() }}

</div></section>

@stop