<?php
class SummaryController extends AuthorizedController {

	public function show()
	{
		$business = $this->business;

		$user = $this->user;
		
		$service = new SummaryComparisonService($this->business);
		$comparison_data = $service->getData();
        $service2 = new SummaryComparisonService2($this->business);
		$comparison_data2 = $service2->getData();
        $service = new SummaryTotalSavingsService($this->business, $comparison_data2);
		$total_savings_data = $service->getData();

		$service = new SummaryGraphService($this->business);
		$graphs_data = $service->getData();
        
        $data = compact('business', 'total_savings_data', 'graphs_data', 'comparison_data', 'comparison_data2', 'user');
        //pd($data);

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
