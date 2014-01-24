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

	/**
	 * Accessor for number of partners
	 *
	 * @return int
	 */
	public function getNumberOfPartnersAttribute()
	{
		return count($this->partners);
	}

	/**
	 * Accessor for Option object from this model
	 *
	 * @return Option
	 */
	public function getOptionAttribute()
	{
		return Option::first();
	}
}
