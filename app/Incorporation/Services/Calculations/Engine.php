<?php namespace \Incorporation\Services\Calculations;


/**
 * Calcuation engine for the Incorporation.
 *
 */
class ExcelEngine {

	/**
	 *
	 * @var PHPExcel
	 */
	protected $objPHPExcel;

	/**
	 *
	 * @var Business
	 */
	protected $business;


	/**
	 * Create a new excel calculation engine
	 * for the business object
	 *
	 * @param  Business $business
	 */
	public function __construct(Business $business)
	{
		$this->objPHPExcel = $this->initEngine($template);
		$this->business = $business;
	}

	/**
	 * Initialize the PHPExcel object.
	 *
	 * @return PHPExcel
	 */
	protected function initEngline()
	{
		$excel_file = storage_path() . "/files/ig.xlsx";
		$excel_format = 'Excel2007';
		$worksheet = 'Incorporation';

		$objReader = PHPExcel_IOFactory::createReader($excel_format); 
		$objReader->setLoadSheetsOnly($worksheet);
		//PHPExcel_Calculation::getInstance()->getDebugLog()->setWriteDebugLog(TRUE);
		return $objReader->load($template); 
	}

	protected function setCellValues(Business $business)
	{
		$this->setOptionsValues($business->options);
		$this->setDataEntryValues($business);
		$this->setPartnersValues($business->partners);
	}

	protected function setOptionsValues(Option $option)
	{
		// @todo implement
	}

	protected function setDataEntryValues(Business $business)
	{
		$cell_columns = array(
			'D12'	=> 'business_entity',
			'D14'	=> 'number_of_partners',
			'D16'	=> 'net_profit_before_tax',
			'D18'	=> 'amount_to_distribute',
			'I21'	=> 'fee_based_on_tax_saved'
		);

		foreach ($cell_columns as $cell => $column) {
			$this->setValue($cell, $business->$column);
		}
	}

	/**
	 *
	 * @param  Illuminate\Database\Eloquent\Collection $partners
	 */
	protected function setPartnersValues($partners)
	{
		$column = 'F';
		$row = '14';

		foreach ($partners as $partner) {
			$this->setValue("{$column}{$row}", $partner->share);
			$row++;
		}
	}

	/**
	 *
	 * @return  PHPExcel
	 */
	public function getEngine()
	{
		return $this->objPHPExcel;
	}

	/**
	 *
	 * @parma  string $cell
	 * @param  mixed  $value
	 * @return self
	 */
	public function setValue($cell, $value)
	{
		$this->objPHPExcel->getActiveSheet()->getCell($cell)->setValue($value); 

		return $this;
	}

	/**
	 *
	 * @return  mixed
	 */
	public function getCalculatedValue($cell)
	{
		return $this->objPHPExcel->getActiveSheet()->getCell($cell)->getCalculatedValue(); 
	}

}
