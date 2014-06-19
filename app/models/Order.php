<?php

class Order extends Eloquent{

	public static $rulesNewOrder = array(
		'product'                  => 'required|integer|exists:products,id',
		'amount'				   => 'required|numeric|min:1',
	    'payment'                  => 'required|in:ideal,creditcard',
	    'av'                       => 'required'
	);

	public function user(){
		return $this->belongsTo('User');
	}

	public function payment() {
		return $this->hasOne('Payment','order_id','id');
	}

	public function products(){
		return $this->belongsToMany('Product','products','order_id','product_id');
	}


}