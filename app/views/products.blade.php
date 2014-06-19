@extends("masters.default")

@section("content")

@foreach( $products as $product)
	<div>{{ trans('interface.productName_'.$product -> nameSlug) }} <a href="{{ action('OrderController@getBuy', array('product' => $product -> id)) }}">Buy</a></div>
@endforeach

@stop