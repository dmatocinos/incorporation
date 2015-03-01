<?php

Class IncomeTaxData extends Eloquent {
	
	protected $softDelete = true;
	
	public function client() {
		return $this->belongsTo('Client');
	}
}

?>