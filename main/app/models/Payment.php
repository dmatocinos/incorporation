<?php

class Payment extends \Eloquent {

	protected $fillable = [	
		'business_id',
		'amount',
		'transaction_id',
		'order_time'
	];

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function business()
	{
		return $this->belongsTo('Business');
	}

}
