<?php

class ResultsController extends AuthorizedController {

	public function show()
	{
		$business = $this->business;

		$service = new SalaryInLimitedCoService($this->business);
		$salary_data = $service->getData();

		$service = new PartnershipTaxAndNationalInsuranceService($this->business);
		$partnership_data = $service->getData();

		$service = new DividendsInLimitedCoService($business);
		$dividends_data = $service->getData();
		
		$data = compact('partnership_data', 'dividends_data', 'salary_data', 'business');
		//pd($data);

		return View::make('results.show', compact('partnership_data', 'dividends_data', 'salary_data', 'business'));
	}

	public function salaryInLimitedCo()
	{
		$service = new SalaryInLimitedCoService($this->business);
		$data = $service->getData();
		$active = 'salary_in_limited_co';

		return View::make('results.salary_in_limited_co', compact('data', 'business'));
	}

	public function partnershipTaxAndNationalInsurance()
	{
		$business = $this->business;
		$service = new PartnershipTaxAndNationalInsuranceService($this->business);
		$data = $service->getData();

		return View::make('results.partnership_tax_and_national_insurance', compact('business', 'data'));
	}

	public function dividendsInLimitedCo()
	{
		$business = $this->business;
		$service = new DividendsInLimitedCoService($business);
		$data = $service->getData();

		return View::make('results.dividends_in_limited_co', compact('business', 'data'));
	}

}
