<?php

use \Incorporation\Services\Calculations\Results\SalaryInLimitedCo as SalaryInLimitedCo;

class SalaryInLimitedCoController extends AuthorizedController {

	public function show()
	{
		$business = Business::first();
		$partners = $business->partners;

		$salary_route_rows = array(
			'taxable_1', 'taxable_2', 'taxable_3', 'taxable_4', 'taxable_5',
			'taxable_ni',
			'ni_due_1', 'ni_due_2',
		);
		$salary_route = array();

		foreach ($partners as $partner) {
			$service = new SalaryInLimitedCo($partner);

			foreach ($salary_route_rows as $row) {
				$fn = 'get' . studly_case($row);
				$salary_route[$row][] = $service->$fn();
			}
		}

		return View::make('salary.show', compact('salary_route', 'partners'));
	}

}
