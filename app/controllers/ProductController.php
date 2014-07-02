<?php

class ProductController extends BaseController{

	public function __construct() {
	    $this->beforeFilter('csrf', array('on'=>'post'));
	}

	public function getIndex(){

		$products = Product::all();



		//{{ $this -> currency(($product -> price_per_hash * $product -> hash)) }}

		return View::make('products')
			->with('products', $products);
	}

	public function getProduct( $id = 1 ){

		//$data['products'] = Product::lists('nameSlug', 'id');


	}

	public function currency( $input = 0 )
	{
		return $input / 100;
	}
}