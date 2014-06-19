<?php

class ProductController extends BaseController{

	public function __construct() {
	    $this->beforeFilter('csrf', array('on'=>'post'));
	}

	public function getIndex(){

		$products = Product::all();

		return View::make('products')
			->with('products', $products);
	}

	public function getProduct( $id = 1 ){

		//$data['products'] = Product::lists('nameSlug', 'id');


	}
}