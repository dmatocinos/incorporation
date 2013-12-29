<?php

class Partner extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'share' => 'required'
	);

	public function business()
	{
		return $this->belongsTo('Business');
	}

	/**
	 * Get the amount of distribution based on partner's share.
	 * F17 = =$D$18*F$14
	 *
	 * @return numeric
	 */
	public function getSalaryAttribute()
	{
		return ($this->share / 100) * $this->business->amount_to_distribute;
	}

}
