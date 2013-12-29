<?php

class Business extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'business_entity' => 'required',
		'net_profit_before_tax' => 'required',
		'amount_to_distribute' => 'required',
		'fee_based_on_tax_saved' => 'required'
	);

	public function partners()
	{
		return $this->hasMany('Partner');
	}

	public function getOptionAttribute()
	{
		return Option::first();
	}
}
