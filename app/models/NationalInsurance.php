<?php

Class NationalInsurance extends Eloquent {
	
	protected $table = 'national_insurance';
	protected $softDelete = true;
	
	public function national_insurance() {
		return $this->belongsTo('Clients','client_id','client_id');
	}
}

?>