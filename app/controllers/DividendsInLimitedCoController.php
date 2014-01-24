<?php

class DividendsInLimitedCoController extends AuthorizedController {

	public function show()
	{
		$business = $this->business;
		$service = new DividendsInLimitedCoService($business);
		$data = $service->getData();

		return View::make('dividends_in_limited_co.show', compact('business', 'data'));
	}

}
