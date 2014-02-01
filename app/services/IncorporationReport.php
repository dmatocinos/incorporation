<?php

class IncorporationReport extends TCPDF {

	protected $business;
	protected $user;

	protected $img_path = 'img/pdf';

	public function __construct(Business $business, User $user)
	{
		parent::__construct(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		$this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		$this->business = $business;
		$this->user = $user;
	}

	public function Header() 
	{
		if ($this->getNumPages() == 1) {
			return;					
		} 

		$pagetext = intval($this->getAliasNumPage());
		$header_title = 'Business Valuation Working Papers';
		if ($this->getNumPages() == 2) {
			
			$pagetext = '';
			$header_title = 'Table of Contents';
		} 
		else {
			$t = intval($this->getAliasNbPages());
			$p = intval($this->getAliasNumPage());
			
			$pagetext = $this->getNumPages() - 2;
		}

		$img = ($this->CurOrientation == 'P' ? 'head-bg-blue.jpg' : 'head-bg-l.jpg');
		$w = ($this->CurOrientation == 'P ' ? 215.9:279.4);
	
		$this->Image($this->img_path . '/' . $img, 0, 0, $w, 25.4, 'JPEG', NULL, NULL, 2);
		
		$this->setTextColor(255, 204, 51);			
		//$this->SetFont('rockb', '', 24, '', true);
		$this->MultiCell(0, 5, $header_title, 0, 'L', 0, 0, '', 8, true);
		//$this->SetFont('rockb', '', 9, '', true);
		$this->MultiCell(0, 5, $pagetext, 0, 'R', 0, 0, '', 15, true);
		
	}

	public function Footer() 
	{
		if ($this->getNumPages() == 1) {
			return;					
		} 

		$img = ($this->CurOrientation == 'P' ? 'head-bg-blue.jpg' : 'head-bg-l.jpg');
		$w = ($this->CurOrientation == 'P ' ? 215.9 : 279.4);
		
		$this->SetY(-24);	

		$this->Image($this->img_path . '/' . $img, 0, 254, $w, 25.4, 'JPEG', NULL, NULL, 2);
		$this->setTextColor(250, 230, 206);
		//$this->SetFont('frabk', '', 10, '', true);

		$confidential_text = 'CONFIDENTIAL - DO NOT DISSEMINATE. This business valuation contains confidential, trade-secret information and is shared only with the understanding that you will not share its contents or ideas with third parties without the express written consent of the plan author.';
		$this->MultiCell(0, 5, $confidential_text, 0, 'L', 0, 0, '', 260, true);
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

		$data['user'] = $this->user;

		return $data;

	}

}
