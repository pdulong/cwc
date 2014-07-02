<?php

class Product extends Eloquent{

	public function orders(){
		return $this->belongsToMany('Order', 'orders', 'product_id', 'order_id');
	}

	public static function formatCurrency( $input = 0)
    {
        return $input / 100;
    }
}