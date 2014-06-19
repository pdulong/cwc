<?php

class Payment extends Eloquent{

	public function order(){
		return $this->belongsTo('Order');
	}

}