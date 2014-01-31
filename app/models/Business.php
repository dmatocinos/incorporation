<?php

class Business extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'business_entity' => 'required',
		'net_profit_before_tax' => 'required|min:1',
		'amount_to_distribute' => 'required|numeric|min:1',
		'fee_based_on_tax_saved' => 'required|numeric|min:1|max:100'
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
	
	public function setPartners($new_partners) 
	{
		$partners = $this->partners()->getResults();
		$count_current_partners = count($partners);
		$count = 0;
		
		foreach ($new_partners as $partner) {
			if ($count < $count_current_partners) {
				$p = $partners->get($count);
				$p->fill(array('share' => $partner['share']));
				$p->update();
			}
			else {
				Partner::create(array('share' => $partner['share'], 'business_id' => $this->id));
			}
			
			$count++;
		}
		
		if ($count < $count_current_partners) {
			for (; $count < $count_current_partners; $count++) {
				$partners->get($count)->delete();
			}
		}
	}
	
	public static function getAll($user_id = NULL) {
		if ($user_id) {
			return DB::select("SELECT * FROM businesses WHERE user_id = :user_id", array('user_id' => $user_id));
		}
		else {
			return DB::select("SELECT * FROM businesses");
		}
	}
}
