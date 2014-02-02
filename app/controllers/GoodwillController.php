<?php

class GoodwillController extends AuthorizedController {

	public function show()
	{
		$service = new GoodwillService($this->business);
		$goodwill_data = $service->excel_engine->getData();

		return View::make('goodwill.show', ['business' => $this->business, 'data' => $goodwill_data]);
	}

	public function download()
	{
		$business = $this->business;

		$service = new GoodwillService($this->business);
		$service->reporter->generate();
	}

}
