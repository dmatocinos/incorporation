<?php

Class CapitalGainsTax extends Eloquent {
	
	protected $table = 'capital_gains_tax';
	protected $softDelete = true;
	
	public function capital_gains_tax() {
		return $this->belongsTo('Clients','client_id','client_id');
	}
}

?>