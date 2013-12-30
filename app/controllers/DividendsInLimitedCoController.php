<?php

use \Incorporation\Services\Calculations\Results\DividendInLimitedCo as DividendInLimitedCo;

class DividendInLimitedCoController extends AuthorizedController {

	public function show()
	{
		$business = Business::first();
		$partners = $business->partners;

		$dividends_route_rows = array(
			'taxable',
			'tax_credit',
			'10_percent_dividend', '32.5_percent_dividend', '42.5_percent_dividend_1', '42.5_percent_dividend_2',
			'total_tax',
			'net_in_pocket',
		);
		$dividends_route = array();

		foreach ($partners as $partner) {
			$service = new DividendInLimitedCo($partner);

			foreach ($dividends_route_rows as $row) {
				$fn = 'get' . studly_case($row);
				$dividends_route[$row][] = $service->$fn();
			}
		}

		return View::make('dividends.show', compact('dividends_route', 'partners'));
	}

}
