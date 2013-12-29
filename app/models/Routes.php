<?php

Class Routes extends Eloquent {
	
	protected $table = 'routes';
	protected $softDelete = true;
	
	public function routes() {
		return $this->belongsTo('Clients','client_id','client_id');
	}
}

?>