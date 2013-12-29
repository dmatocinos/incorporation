<?php

Class IncomeTaxData extends Eloquent {
	
	protected $table = 'income_tax_data';
	protected $softDelete = true;
	
	public function income_tax_data() {
		return $this->belongsTo('Clients','client_id','client_id');
	}
}

?>