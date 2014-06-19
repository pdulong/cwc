<?php

class Product extends Eloquent{

	public function orders(){
		return $this->belongsToMany('Order', 'orders', 'product_id', 'order_id');
	}
}