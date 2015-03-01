<?php

class PartnershipTaxAndNationalInsuranceController extends AuthorizedController {

	public function show()
	{
		$business = $this->business;
		$service = new PartnershipTaxAndNationalInsuranceService($this->business);
		$data = $service->getData();

		return View::make('partnership_tax_and_national_insurance.show', compact('business', 'data'));
	}

}
