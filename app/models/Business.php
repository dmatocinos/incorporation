<?php

class Business extends Eloquent {
	protected $guarded = array();
	protected $softDelete = true;

	protected $fillable = [
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

	public function getBusinessEntityAttribute($value)
	{
		if ($client = $this->getClient()) {
			return $client->business_type;
		}
		return null;
	}
	
	public static function getAll($user_id = NULL) 
	{
		if ($user_id) {
			return Business::where('user_id', '=', $user_id)
				->whereRaw('deleted_at IS NULL')
				->where('client_id', '<>', 0)
				->get();
		}
		else {
			return Business::whereRaw('deleted_at IS NULL')
				->where('client_id', '<>', 0)
				->get();
		}
	}

	public function getClient()
	{
		return Client::find($this->client_id);
	}
    
	public function isPartnership() 
	{
		return $this->business_entity == 'Partnership' ? true: false;
	}

	public static function saveBusiness($data)
	{
		// business user id
		$data['user_id'] = Auth::user()->id;

		if (isset($data['business_id']) && is_numeric($data['business_id'])) {
			$business = Business::find($data['business_id']);
			$business->fill($data);
			$business->save();
		}
		else {
			$business = Business::create($data);
		}

		// client user id
		$data['user_id'] = Auth::user()->practicepro_user_id;

		$data['period_start_date'] =  date('Y-m-d', strtotime($data['period_start_date']));
		$data['period_end_date'] =  date('Y-m-d', strtotime($data['period_end_date']));
		$data['business_type'] = $data['business_entity'];

		if ($business->client_id){
			$client = Client::find($business->client_id);
			$client->fill($data);
			$client->save();
		}
		else {
			$client = Client::create($data);
			$business->client_id = $client->id;
			$business->save();
		}

		return $business;
	}
}
