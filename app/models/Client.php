<?php

Class Client extends Eloquent {
	
	protected $softDelete = true;
	
	public function client_tax_infos() {
		return $this->hasMany('ClientTaxTableInfo');
	}
	
	public function capitalisations() {
		return $this->hasMany('Capitalisation');
	}
	
	public function capital_gains_taxes() {
		return $this->hasMany('CapitalGainsTax');
	}
	
	public function corporation_taxes() {
		return $this->hasMany('CorporationTax');
	}
	
	public function dividend_routes() {
		return $this->hasMany('DividendRoute');
	}
	
	public function income_tax_data() {
		return $this->hasMany('IncomeTaxData');
	}
	
	public function national_insurances() {
		return $this->hasMany('NationalInsurance');
	}
	
	public function overall_taxes() {
		return $this->hasMany('OverallTax');
	}
	
	public function routes() {
		return $this->hasMany('Route');
	}
}

?>