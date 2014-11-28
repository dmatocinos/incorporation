<?php
class SummaryController extends AuthorizedController {

	public function show()
	{
		$business        = $this->business;
		$user            = $this->user;
        $service         = new SummaryComparisonServiceProRebuild($this->business);
        $comparison_data = $service->getData();
        unset($service);
        
        $service = new SummaryTotalSavingsService($this->business, $comparison_data['limited_company']);
		$total_savings_data = $service->getData();
        unset($service);

		$service = new SummaryGraphService($this->business);
		$graphs_data = $service->getData();
        unset($service);

        $data = compact('user', 'business', 'comparison_data', 'total_savings_data', 'graphs_data');

		return View::make('summary.show', $data);
	}

	public function totalSavings()
	{
		$business = $this->business;
		$service = new SummaryTotalSavingsService($this->business);
		$data = $service->getData();

		return View::make('summary.total_savings', compact('business', 'data'));
	}

	public function graphs()
	{
		$service = new SummaryGraphService($this->business);
		$data = $service->getData();

		return View::make('summary.graphs', compact('data'));
	}

	public function restrictDownloads($business_id)
	{
		return Redirect::to('summary/' . $business_id)
			->with('message', "Sorry, valuation report is not downloadable for Free Trial membership. You may want to upgrade to other packages to fully use this application.");
	}

}
