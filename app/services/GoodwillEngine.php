<?php

class GoodwillEngine extends ExcelEngine {

	protected $business;
	protected $partners;

	protected $data = [];

	public function __construct(Business $business)
	{
		parent::__construct('Goodwill');

		$this->business = $business;
		$this->partners = DB::select('SELECT * FROM partners WHERE business_id = :business_id', 
					array('business_id' => $business->id)
		);
		
		$this->init();
	}

	protected function init()
	{
		// set worksheet data
		$this->setCellValues($this->business);

		// retrieve and set data from worksheet
		$this->setDataCapitalGainOnBusinessTransfer();	
		$this->setDataPossibleTaxSavings();
		$this->setDataTaxByDividend();
		$this->setDataSummary();

		$this->setDataForGraphs();
	}

	public function setData($rows, $columns)
	{
		foreach ($rows as $row_key => $cell_row) {
			foreach ($columns as $column_key => $cell_column) {
				$this->data[$row_key][$column_key] = $this->getFormattedValue("{$cell_column}{$cell_row}");
			}
		}
	}

	public function setDataCapitalGainOnBusinessTransfer()
	{
		$rows = [
			'gain_before_tax_due' 			=> 22,
			'less_annual_exemption'			=> 24,
			'gain_liable_to_capital_gains_tax'	=> 26,
			'possible_total_tax_due_on_gain'	=> 28
		];
		
		$cell_column = 'E';
		
		foreach ($rows as $row_key => $cell_row) {
			$this->data['capital_gain_on_business_transfer'][$row_key] = $this->getFormattedValue("{$cell_column}{$cell_row}");
		}
	}

	public function setDataPossibleTaxSavings()
	{
		$rows = [
			'possible_tax_savings_on_goodwill_amortised'	=> 34,
			'first_year_savings_in_the_company'		=> 36
		];

		$cell_column = 'E';
		
		foreach ($rows as $row_key => $cell_row) {
			$this->data['possible_tax_savings'][$row_key] = $this->getFormattedValue("{$cell_column}{$cell_row}");
		}
	}

	public function setDataTaxByDividend()
	{
		$columns = [
			'gross_dividend' => 'K', 
			'tax_due'	 => 'M'
		];

		foreach ($columns as $name => $cell_column) {
			$row_num = 25;
			$num = 1;
			foreach ($this->partners as $partner) {
				$this->data['tax_by_dividend'][$num][$name] = $this->getFormattedValue("{$cell_column}{$row_num}");
				$row_num = $row_num + 2;
				$num++;
			}
		}
		$this->data['tax_by_dividend']['total_dividend_tax_if_dividend'] = $this->getFormattedValue("M36");
	}	

	public function setDataSummary()
	{
		$rows = [
			'cost_in_cgt_on_business_partner'	=> 41,
			'goodwill_savings_obtained'		=> 42,
			'dividend_tax_saved_on_extraction'	=> 43,
			'net_savings_made'			=> 44,
			'overall_savings'			=> 45,
			'bpk_fee_for_capitalisation'		=> 47
		];

		$cell_column = 'I';
		
		foreach ($rows as $row_key => $cell_row) {
			$this->data['summary'][$row_key] = $this->getFormattedValue("{$cell_column}{$cell_row}");
		}
	}


	public function setDataForGraphs()
	{
		$rendererName = PHPExcel_Settings::CHART_RENDERER_JPGRAPH;
		$rendererLibraryPath = app_path() . '/../vendor/jpgraph';

		if ( ! PHPExcel_Settings::setChartRenderer(
			$rendererName,
			$rendererLibraryPath
		)) {
			die(
				'NOTICE: Please set the $rendererName and $rendererLibraryPath values' .
				'<br>' .
				'at the top of this script as appropriate for your directory structure'
			);
		}

		$worksheet = $this->getActiveSheet();
		$chartNames = $worksheet->getChartNames();
		foreach ($chartNames as $i => $chartName) {
			$chart = $worksheet->getChartByName($chartName);
			$chart = $worksheet->getChartByName($chartName);
			
			// get unique file name
			$caption = sprintf("%s_%s", uniqid(), $i);
			
			$asset_path = "/cache/{$caption}.jpg";
			$jpegFile = public_path() . $asset_path;
			$chart->render($jpegFile);
			$this->data['graphs'][$caption] = $asset_path;
		}
	}

	public function setCellValues(Business $business)
	{
		$this->setWorksheetDataEntryValues($business);
		$this->setWorksheetPartnersValues($business->partners);
	}

	protected function setWorksheetDataEntryValues(Business $business)
	{
		$cell_columns = array(
			'E10'	=> 'goodwill_estimated_value',
			'E16'	=> 'existing_business_commenced',
			'E17'	=> 'goodwill_write_off_years'
		);

		foreach ($cell_columns as $cell => $column) {
			$value = $business->$column;
			$this->setValue($cell, $value);
		}
		
		$this->setValue('E2', count($this->partners));
		$this->setValue('C14', ($business->fee_based_on_tax_saved / 100));
	}

	/**
	 *
	 * @param  Illuminate\Database\Eloquent\Collection $partners
	 */
	protected function setWorksheetPartnersValues($partners)
	{
		$columns = array('I', 'J', 'K', 'L', 'M');
		$rows = array('12', '13');
		$count = 0;

		foreach ($rows as $row) {
			foreach ($partners as $partner) {
				if ($row == '12') {
					$this->setValue("{$columns[$count]}{$row}", ($partner->share / 100));
				}
				else {
					$this->setValue("{$columns[$count]}{$row}", ($this->business->goodwill_estimated_value * ($partner->share / 100)));
				}
			}
		}
	}

	public function getData()
	{
		return $this->data;
	}

}
