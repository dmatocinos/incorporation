<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Carbon\Carbon;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');
	
	protected $fillable = [
		'username',
		'password',
		'practicepro_user_id',
		'email'
	];

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Accessor for valid_until. Use user->valid_until
	 * 
	 * @return Carbon
	 */
	public function getValidUntilAttribute()
	{
		if ( ! $this->attributes['valid_until']) {
			return NULL;
		}

		return $this->asDateTime($this->attributes['valid_until']);
	}

	/**
	 * Check if user is still subscribed. A user is subscribed if the discounted
	 * amount is 0 (FREE) or subscription date is still valid
	 *
	 * @return bool
	 */
	public function getIsSubscribedAttribute()
	{
		$is_free = $this->practice_pro_user->pricing->is_free;
		
		if ($this->valid_until) {
			$now = Carbon::now();
			$is_subscription_valid = $this->valid_until->gte($now);
		}
		else {
			$is_subscription_valid = FALSE;
		}

		return $is_free || $is_subscription_valid;
	}

	public function getCompanyNameAttribute()
 	{
		// @todo update import to include mh2_company_name from practicepro
		return $this->mh2_company_name; 
 	}


	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	/**
	 * User - PracticeProUser one-to-one relationship
	 *
	 */
	public function practiceProUser()
	{
		return $this->belongsTo('PracticeProUser', 'username', 'mh2_id');
	}

	
	public static function findPracticeProUser($id) {
		return User::where('practicepro_user_id', $id)->first();
	}
    
    public function getRememberToken()
	{

	}

	public function setRememberToken($value)
	{

	}

	public function getRememberTokenName()
	{

	}
}
