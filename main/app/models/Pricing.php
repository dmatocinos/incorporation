<?php

use \Carbon\Carbon;

class Pricing extends Eloquent {
	protected $guarded = array();

	/**
	 * The database connection name where the
	 * table's database is located
	 *
	 * @var string
	 */
	protected $connection = 'practicepro_users';
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'application_discounts';

	/**
	 * Table's primary key
	 *
	 * @var string
	 */
	protected $primaryKey = 'application_discount_id';

	public static $rules = array();

	/**
	 * L4.1.x version only
	 *
	public function practiceProUsers()
	{
		return $this->hasMany('PracticeProUser', 'mh2_membership_level', 'membership_level');
	}
	 */
	public function getPracticeProUsersAttribute()
	{
		return PracticeProUser::where('mh2_membership_level', '=', $this->membership_level)->get();
	}

	/**
	 * Get the amount to be paid by user after deducting the discount.
	 *
	 * @return numeric
	 */
	public function getDiscountedAmount()
	{
		$amount = $this->getAmount();

		return $amount - ($amount * $this->discount);
	}

	/**
	 * Product is free if discounted amount equals to 0.
	 *
	 * @return bool
	 */
	public function getIsFreeAttribute()
	{
		return $this->getDiscountedAmount() == 0;
	}

	/**
	 * Get the undiscounted amount for this product.
	 *
	 * @return numeric
	 */
	public function getAmount()
	{
		return Config::get('paypal.amount');
	}

	/**
	 *
	 * @return Carbon
	 */
	public function getNewSubscriptionExpiration($user)
	{
		$now = Carbon::now();
		$valid_until = $user->valid_until;

		// if the user is paying before the subscription is expired,
		// add 1 month to expiration date, else, add 1 month from now
		if ($valid_until && $valid_until->gt($now)) {
			return $valid_until->addMonth();
		}
		else {
			return $now->addMonth();
		}
	}

}
