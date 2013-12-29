<?php

class Option extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'higher_dividend_threshold_j' => 'required',
		'higher_dividend_threshold_k' => 'required',
		'dividend_threshold_i' => 'required',
		'dividend_threshold_j' => 'required',
		'dividend_threshold_k' => 'required',
		'corporate_tax_rate_j' => 'required',
		'corporate_tax_rate_k' => 'required',
		'main_rate' => 'required',
		'employees_ni_i' => 'required',
		'employees_ni_j' => 'required',
		'employees_ni_k' => 'required',
		'employees_ni_l' => 'required',
		'employers_ni_j' => 'required',
		'employers_ni_k' => 'required',
		'income_tax_and_ni_i' => 'required',
		'income_tax_and_ni_j' => 'required',
		'income_tax_and_ni_k' => 'required',
		'income_tax_and_ni_l' => 'required',
		'j8' => 'required',
		'k8' => 'required',
		'j9' => 'required',
		'k9' => 'required'
	);
}
