<?php

class GoodwillReporter {
	
	protected $business;
	protected $excel_engine;
	protected $pdf;
		
	public function __construct(Business $business, GoodwillEngine $excel_engine)
	{
		$this->business = $business;
		$this->excel_engine = $excel_engine;
	}
	
	public function setupPdf()
	{
		$this->pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$this->pdf->SetCreator('');
		$this->pdf->SetAuthor('Pro Media Consultants');
		$this->pdf->SetTitle('Goodwill Report');
		$this->pdf->SetSubject('PDF Export');

		// set default header data
	//	$this->pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

		// set header and footer fonts
		$this->pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$this->pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$this->pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$this->pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$this->pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$this->pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$this->pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$this->pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			require_once(dirname(__FILE__).'/lang/eng.php');
			$this->pdf->setLanguageArray($l);
		}

		// set font
		$this->pdf->SetFont('dejavusans', '', 10);

		// add a page
		$this->pdf->AddPage();

		// output the HTML content
		$this->pdf->writeHTML($this->html, true, false, true, false, '');

		// reset pointer to the last page
		$this->pdf->lastPage();


		//Close and output PDF document
		$this->pdf->Output("Goodwill_Report.pdf", 'I');

	}
	
	public function buildHtml()
	{
		$this->html = View::make("goodwill.pdf_styles")->render();
		$this->html .= View::make(
			"goodwill.report", 
			['business' => $this->business, 'excel_engine' => $this->excel_engine]
		)->render();
	}

	public function generate()
	{
		$this->buildHtml();
		$this->setupPdf();
	}
}
