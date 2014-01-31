<?php

class IncorporationReport extends TCPDF {

	protected $business;

	public function __construct(Business $business)
	{
		parent::__construct(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		$this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		$this->business = $business;
	}

	public function toPdf() {
		$pages = array(
			'introduction',
			'benefits',
			'summary',
			'services',
			'acknowledgement'
		);
		foreach ($pages as $page) {
			$fn = 'build' . ucwords($page);

			$data = method_exists($this, $fn) ? $this->$fn() : array();

			$html = View::make("pdf/incorporation/{$page}", $data)->render();

			$this->AddPage();
			$this->writeHTML($html, true, false, true, false, '');

		}

		$this->Output("valuation.pdf", 'I');
	}

	public function buildSummary()
	{
		$data = array();

		$service = new SummaryTotalSavingsService($this->business);
		$data['total_savings_data'] = $service->getData();

		$service = new SummaryGraphService($this->business);
		$data['graphs_data'] = $service->getData();

		return $data;

	}

}
