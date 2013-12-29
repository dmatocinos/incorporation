<?php

Class ClientTaxTableInfo extends Eloquent {

	protected $table = 'client_tax_info';
	protected $softDelete = true;
	
	public function client_tax_info() {
		return $this->belongsTo('Clients','client_id','client_id');
	}
}

?>