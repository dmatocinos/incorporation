<?php

Class Capitalisation extends Eloquent {
	
	protected $table = 'capitalisation';
	protected $softDelete = true;
	
	public function capitalisation() {
		return $this->belongsTo('Clients','client_id','client_id');
	}
}

?>