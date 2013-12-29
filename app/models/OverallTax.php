<?php

Class OverallTax extends Eloquent {
	
	protected $table = 'overall_tax';
	protected $softDelete = true;
	
	public function overall_tax() {
		return $this->belongsTo('Clients','client_id','client_id');
	}
}

?>