<?php
use \Incorporation\Services\Calculations\Summary\Dividends as DividendsSummaryCo;
use \Incorporation\Services\Calculations\Summary\Partnership as PartnershipSummaryCo;
use \Incorporation\Services\Calculations\Summary\SalaryInLtd as SalaryInLtdSummaryCo;
use \Incorporation\Services\Calculations\Summary\SoleTrade as SoleTradeSummaryCo;

class SummaryController extends AuthorizedController {

	public function show()
	{
		$business = Business::first();
		//$partners = $business->partners;

			$dividends_data = new DividendsSummaryCo($business);
			$partnership_data = new PartnershipSummaryCo($business);
			$salary_data = new SalaryInLtdSummaryCo($business);
			$soletrade_data = new SoleTradeSummaryCo($business);

		return View::make('summary.table', compact('dividends_data', 'partnership_data','salary_data','soletrade_data'));
	}

}
