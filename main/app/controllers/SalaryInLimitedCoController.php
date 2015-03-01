<?php

class SalaryInLimitedCoController extends AuthorizedController {

	public function show()
	{
		$business = $this->business;
		$service = new SalaryInLimitedCoService($this->business);
		$data = $service->getData();

		return View::make('salary_in_limited_co.show', compact('data', 'business'));
	}

}
