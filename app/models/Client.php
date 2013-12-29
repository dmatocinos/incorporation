<?php

Class Client extends Eloquent {
	
	protected $table = 'clients';
	protected $softDelete = true;
	
	public function clients() {
		return $this->hasMany('ClientTaxTableInfo');
	}
}

?>