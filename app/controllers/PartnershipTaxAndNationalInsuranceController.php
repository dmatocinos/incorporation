<?php

use \Incorporation\Services\Calculations\Results\PartnershipTaxAndNationalInsuranceController as PartnershipTaxAndNationalInsuranceController;

class PartnershipTaxAndNationalInsuranceControllerController extends AuthorizedController {

	public function show()
	{
		$business = Business::first();
		$partners = $business->partners;

		$partnership_route_rows = array(
			'taxable',
			'tax_due_1', 'tax_due_2', 'tax_due_3', 'tax_due_4',
			'taxable_ni',
			'ni_due_1', 'ni_due_2',
		);
		$partnership_route = array();

		foreach ($partners as $partner) {
			$service = new PartnershipTaxAndNationalInsuranceController($partner);

			foreach ($partnership_route_rows as $row) {
				$fn = 'get' . studly_case($row);
				$partnership_route[$row][] = $service->$fn();
			}
		}

		return View::make('partnership.show', compact('partnership_route', 'partners'));
	}

}
