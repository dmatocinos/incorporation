<?php

Class CorporationTax extends Eloquent {
	
	protected $table = 'corporation_tax';
	protected $softDelete = true;
	
	public function corporation_tax() {
		return $this->belongsTo('Clients','client_id','client_id');
	}
}

?>