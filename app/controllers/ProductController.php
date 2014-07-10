<?php

class ProductController extends BaseController{

	public function __construct() {
	    $this->beforeFilter('csrf', array('on'=>'post'));
	}

	public function getIndex(){

		$products = Product::all();

		$mainPrice = Product::orderBy('price_per_hash','asc')->first()->price_per_hash;

		return View::make('products', array(
			'cheapestPrice'	=> $mainPrice,
			'thisMonthRev' => 1680,
		))->with('products', $products);
	}

	public function tandc( $language = 'en' )
	{
		return View::make('av_' . $language);
	}

	public function getProduct( $id = 1 ){

		//$data['products'] = Product::lists('nameSlug', 'id');

	}

	public function currency( $input = 0 )
	{
		return $input / 100;
	}
}