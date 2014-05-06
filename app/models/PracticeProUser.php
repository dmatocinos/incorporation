<?php

/**
 * A wrapper to the practice pro users table 
 *
 * @author mmacaso
 */
 
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class PracticeProUser extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * Default password
	 *
	 * @var string
	 */
	const BIZVAL_PASSWORD = "v4Lu@t10n**!!";
	
	/**
	 * Default pay as you go limit
	 *
	 * @var string
	 */
	const PAYASYOUGO_LIMIT = 6;
	
	/**
	 * Default pro active limit
	 *
	 * @var string
	 */
	const PROACTIVE_LIMIT = 11;
	
	/**
	 * Default professional limit
	 *
	 * @var string
	 */
	const PROFESSIONAL_LIMIT = 41;

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
	protected $table = 'practice_pro_login';

	/**
	 * Table's primary key
	 *
	 * @var string
	 */
	protected $primaryKey = 'mh2_id';

	/**
	 * There are no updated_at and created_At column
	 *
	 * @var boolean
	 */
	public $timestamps = FALSE;
	
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');
	
	public static function findByEmail($email, $password) {
		// TODO: do we need to use restful?
		// TODO: check also if the user has the permission to use biz val
		return DB::connection('practicepro_users')
			->select(DB::raw("SELECT * FROM practice_pro_login WHERE mh2_email = :email AND mh2_password = :password LIMIT 1"), array(
				'email'    => $email,
				'password' => md5($password)
			));
	}

	public static function findByEmailWithoutPassword($email) {
		// TODO: do we need to use restful?
		// TODO: check also if the user has the permission to use biz val
		return DB::connection('practicepro_users')
			->select(DB::raw("SELECT * FROM practice_pro_login WHERE mh2_email = :email LIMIT 1"), array(
				'email'    => $email
			));
	}

	/**
	 * User - PracticeProUser relationship definition
	 *
	 */
	public function user()
	{
		return $this->hasOne('User', 'username', 'mh2_id');
	}


	/**
	 * L4 needs to be updated to 4.1.x for this to work. For now, let's use accessor
	 *
	public function pricing()
	{
		return $this->belongsTo('Pricing', 'membership_level', 'mh2_membership_level');
	}
	*/
	public function getPricingAttribute()
	{
		return Pricing::where('membership_level_id', '=', $this->membership_level)
			->where('application_id', '=', function($query)
				{
					$query->select(DB::raw('application_id'))
                      ->from('applications')
                      ->where('application_key', '=', Config::get('app.application_key'));
				})
			->first();
	}

	/**
	 * Alias to mh2_membership_level attribute
	 *
	 * @return string
	 */
	public function getMembershipLevelAttribute()
	{
		return $this->mh2_membership_level;
	}
	
	public function getMembershipLevelDisplayAttribute()
	{
		$result = DB::connection($this->connection)
			->select(DB::raw("SELECT display FROM membership_levels WHERE membership_level_id = :membership_level_id LIMIT 1"), array(
				'membership_level_id' => $this->membership_level
			));
		
		return $result[0]->display;
	}

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
		return $this->mh2_password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->mh2_email;
	}

	public function getMembershipLevelIdByKey($key)
	{
		$result = DB::connection($this->connection)
			->select(DB::raw("SELECT membership_level_id FROM membership_levels WHERE membership_level_key = :membership_level_key LIMIT 1"), array(
				'membership_level_key' => $key
			));
		
		return $result[0]->membership_level_id;
	}

	public function getMembershipLevelDisplayByKey($key)
	{
		$result = DB::connection($this->connection)
			->select(DB::raw("SELECT display FROM membership_levels WHERE membership_level_key = :membership_level_key LIMIT 1"), array(
				'membership_level_key' => $key
			));
		
		return $result[0]->display;
	}

	public function currentUser()
	{
		$user = self::findByEmailWithoutPassword($this->mh2_email);
		return $user[0];
	}

	public function admitDownload()
	{
		DB::connection($this->connection)
			->update('update practice_pro_login set download_count = ? where mh2_id = ?', array($this->currentUser()->download_count + 1, $this->currentUser()->mh2_id));
	}

	public function getLimit()
	{
		switch ($this->getMembershipLevelDisplayAttribute()) {
			case 'Pay As You Go':
				$limit = self::PAYASYOUGO_LIMIT;
				break;
			case 'Pro Active':
				$limit = self::PROACTIVE_LIMIT;
				break;
			case 'Professional':
				$limit = self::PROFESSIONAL_LIMIT;
				break;
		}

		return $limit;
	}	

	public function canDownload()
	{
		if ($this->isLimitExpired()) {
			$this->resetDownloadLimit();
		}

		return ((int) $this->currentUser()->download_count < $this->getLimit() || $this->currentUser()->is_god);
	}

	public function resetDownlodLimit()
	{
		$user = $this->currentUser();

		DB::connection($this->connection)
			->update('update practice_pro_login set download_count = 0 where mh2_id = ?', array($user->mh2_id));
		
	}

	public function isLimitExpired()
	{	
		$created_at = $this->currentUser()->created_at == '0000-00-00 00:00:00' ? $this->currentUser()->mh2_reg_date : $this->currentUser()->created_at;
		$expired_date = date('Y-m-d H:i:s', strtotime('+1 year', strtotime($created_at)));
		$today = new DateTime("now");

		return ($expired_date < $today->format('Y-m-d H:i:s'));
	}

	public function payment($params)
	{
		$user = $this->currentUser();
		$today = new DateTime("now");

		DB::connection($this->connection)
			->insert('insert into payments (user_id, amount, transaction_id, order_time, created_at, updated_at) values (?, ?, ?, ?, ?, ?)', 
					array($user->mh2_id, $params['amount'], $params['transaction_id'], $params['order_time'], $today->format('Y-m-d H:i:s'), $today->format('Y-m-d H:i:s')));

	}

	public function upgradeMembershipLevel($level)
	{
		$user = $this->currentUser();

		DB::connection($this->connection)
			->update('update practice_pro_login set mh2_membership_level = ? where mh2_id = ?', array($this->getMembershipLevelIdByKey($level), $user->mh2_id));

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
