<?php

class Business extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'business_entity' => 'required',
		'net_profit_before_tax' => 'required|min:1',
		'fee_based_on_tax_saved' => 'required|numeric|min:1|max:100',
	//	'has_goodwill' => 'numeric|min:0',
	//	'goodwill_estimated_value' => 'required|min:1',
	//	'existing_business_commenced' => 'required|min:1',
	//	'goodwill_write_off_years' => 'required|min:1'
	);

	public function partners()
	{
		return $this->hasMany('Partner');
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
	
	public static function getAll($user_id = NULL) 
	{
		if ($user_id) {
			return DB::select("SELECT * FROM businesses WHERE user_id = :user_id", array('user_id' => $user_id));
		}
		else {
			return DB::select("SELECT * FROM businesses");
		}
	}
    
    public function isPartnership() 
    {
        return $this->business_entity == 'Partnership' ? true: false;
    }
}
