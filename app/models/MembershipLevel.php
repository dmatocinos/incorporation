<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class MembershipLevel extends Eloquent {

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
	protected $table = 'membership_levels';
	
	/**
	 * The database table prmary key.
	 *
	 * @var string
	 */
	protected $primaryKey = "membership_level_id";

	public static function getMembershipLevelId($key)
	{
		return MembershipLevel::where('membership_level_key', $key)->pluck('membership_level_id');
	}

}
