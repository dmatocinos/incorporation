<?php

abstract class IncorporationEngineProRebuild extends ExcelEngine {

	protected $business;
	protected $partners;

	protected $data;

	public function __construct(Business $business)
	{
		parent::__construct(null, '/files/Incorporation pro rebuild 2.10.14.xlsx');

		$this->business = $business;
		$this->data     = array();

        $this->setCellValues($business);
		$this->init();
	}

	public function getData()
	{
		return $this->data;
	}

	protected abstract function init();

	protected function setCellValues(Business $business)
	{
		$this->setDataEntryValues($business);
	}

	protected function setDataEntryValues(Business $business)
	{
        $this->getEngine()->setActiveSheetIndex(0);

		$cell_columns = array(
			'C6'	=> 'business_entity',
            'C8'	=> 'number_of_partners',
			'C10'	=> 'net_profit_before_tax',
			'C12'	=> 'fee_based_on_tax_saved',
            'C14'	=> 'directors_salary_per_individual'
		);

		foreach ($cell_columns as $cell => $column) {
			$value = $business->$column;
			$this->setValue($cell, $value);
		}
	}

	protected function test()
	{
		$cell_columns = array(
			'D12'	=> 'business_entity',
			'D14'	=> 'number_of_partners',
			'D16'	=> 'net_profit_before_tax',
			'D18'	=> 'amount_to_distribute',
			'I21'	=> 'fee_based_on_tax_saved'
		);
		$test = array();
		foreach ($cell_columns as $cell => $column) {
			$test[$cell] = $this->getFormattedValue($cell);
		}

		$column = 'F';
		$row = '14';

		foreach ($this->business->partners as $partner) {
			$test["{$column}{$row}"] = $this->getFormattedValue("{$column}{$row}");
			$column++;
		}

		var_dump($test);
	}

	protected function testFormula($sheet,$cell) {
		$formulaValue = $sheet->getCell($cell)->getValue();
		echo 'Formula Value is' , $formulaValue , PHP_EOL;
		$expectedValue = $sheet->getCell($cell)->getOldCalculatedValue();
		echo 'Expected Value is '  , 
			((!is_null($expectedValue)) ? 
			$expectedValue : 
			'UNKNOWN'
		) , PHP_EOL;

		$calculate = false;
		try {
			$tokens = PHPExcel_Calculation::getInstance()->parseFormula($formulaValue,$sheet->getCell($cell));
			echo 'Parser Stack :-' , PHP_EOL;
			print_r($tokens);
			echo PHP_EOL;
			$calculate = true;
		} catch (Exception $e) {
			echo 'PARSER ERROR: ' , $e->getMessage() , PHP_EOL;

			echo 'Parser Stack :-' , PHP_EOL;
			print_r($tokens);
			echo PHP_EOL;
		}

		if ($calculate) {
			try {
				$cellValue = $sheet->getCell($cell)->getCalculatedValue();
				echo 'Calculated Value is ' , $cellValue , PHP_EOL;

				echo 'Evaluation Log:' , PHP_EOL;
				echo PHP_EOL;
			} catch (Exception $e) {
				echo 'CALCULATION ENGINE ERROR: ' , $e->getMessage() , PHP_EOL;

				echo 'Evaluation Log:' , PHP_EOL;
				echo PHP_EOL;
			}
		}
	}
}
