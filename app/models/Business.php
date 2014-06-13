<?php

class Business extends Eloquent {
	protected $guarded = array();
	protected $softDelete = true;

	protected $fillable = [
		'business_entity', 
		'net_profit_before_tax',
		'amount_to_distribute', 
		'fee_based_on_tax_saved',
		'goodwill_estimated_value', 
		'existing_business_commenced',
		'goodwill_write_off_years',
		'has_goodwill',
		'user_id',
		'number_of_partners',
		'client_id'	 
	];

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
			return DB::select("SELECT * FROM businesses WHERE user_id = :user_id AND deleted_at IS NULL", array('user_id' => $user_id));
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
