<?php

class GoodwillReporter extends TCPDF {
	
	protected $business;
	protected $pdf;
		
	public function __construct(Business $business)
	{
		parent::__construct(PDF_PAGE_ORIENTATION, PDF_UNIT, array(215.9,279.4), true, 'UTF-8', false);

		$this->business = $business;
	}

	public function Header() 
	{
		$header_title = 'Your Goodwill Report';
		
		$this->setTextColor(69, 167, 196);			
		$this->SetFont('rockb', '', 24, '', true);
		$this->MultiCell(0, 5, $header_title, 0, 'C', 0, 0, '', 8, true);
		
	}

	public function Footer() 
	{
	}
	
	public function setupPdf()
	{
		
		// set document information
		$this->SetCreator('');
		$this->SetAuthor('Pro Media Consultants');
		$this->SetTitle('Goodwill Report');
		$this->SetSubject('PDF Export');

		// set default header data
	//	$this->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

		// set header and footer fonts
		$this->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$this->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$this->SetMargins(PDF_MARGIN_LEFT, 25, PDF_MARGIN_RIGHT);
		$this->SetHeaderMargin(8);
		$this->SetFooterMargin(1);		

		// set auto page breaks
		$this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$this->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			require_once(dirname(__FILE__).'/lang/eng.php');
			$this->setLanguageArray($l);
		}

		// set font
		$this->SetFont('dejavusans', '', 10);

		// add a page
		$this->AddPage();

		// output the HTML content
		$this->writeHTML($this->html, true, false, true, false, '');

		// reset pointer to the last page
		$this->lastPage();


		//Close and output PDF document
		//$this->Output("Goodwill_Report.pdf", 'I');
		$this->Output("Goodwill_Report.pdf", 'D');

	}
	
	public function buildHtml($params = [])
	{
		
		$params = array_merge(['data' => $params], ['business' => $this->business, 'user' => Session::get('practicepro_user')]);
		$this->html = View::make("goodwill.pdf_styles")->render();
		$this->html .= View::make(
			"goodwill.report", 
			$params
		)->render();
	}

	public function generate($params = [])
	{
		$this->buildHtml($params);
		$this->setupPdf();
	}
}
