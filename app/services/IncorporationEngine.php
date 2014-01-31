<?php

abstract class IncorporationEngine extends ExcelEngine {

	protected $business;
	protected $partners;

	protected $data;

	public function __construct(Business $business)
	{
		parent::__construct('Incorporation');

		$this->business = $business;
		$this->data = array();

		$this->setCellValues($business);
		//$this->test();
		//$sheet = $this->objPHPExcel->getActiveSheet();
		//$this->testFormula($sheet, 'H28');
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
		$this->setPartnersValues($business->partners);
	}

	protected function setDataEntryValues(Business $business)
	{
		$cell_columns = array(
			'D12'	=> 'business_entity',
			'D16'	=> 'net_profit_before_tax',
			'D18'	=> 'amount_to_distribute',
			'I21'	=> 'fee_based_on_tax_saved'
		);

		foreach ($cell_columns as $cell => $column) {
			if ($cell == 'I21') {
				$value = $business->$column / 100;
			}
			else {
				$value = $business->$column;
			}

			$this->setValue($cell, $value);
		}
		
		$this->setValue('D14', count($business->partners));
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

	/**
	 *
	 * @param  Illuminate\Database\Eloquent\Collection $partners
	 */
	protected function setPartnersValues($partners)
	{
		$columns = array('F', 'G', 'H', 'I', 'J');
		$row = '14';
		$count = 0;
		$total_partners = count($partners);

		for ($count = 0; $count < $total_partners; $count++) {
			$this->setValue("{$columns[$count]}{$row}", ($partners->get($count)->share / 100));
		}
	}

}
