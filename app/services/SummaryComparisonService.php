<?php

class SummaryComparisonService extends IncorporationEngine {

	protected function init()
	{
		$rows = array(
			'corporation_tax'	=> 28,
			'income_tax'		=> 29,
			'employer'		    => 32,
			'employee'		    => 33,
			'total_to_hmrc'		=> 35,
			'net_in_pocket'		=> 37,
			'left_in_company'	=> 38,
			'amount_retained'	=> 40
		);

		$columns = array(
			'sole_trade'	=> 'D',
			'partnership'	=> 'F',
			'salary_in_ltd'	=> 'H',
			'dividends'	    => 'J'
		);

		$test = array();
		
		foreach ($rows as $row_key => $cell_row) {
			foreach ($columns as $column_key => $cell_column) {
				$this->data[$row_key][$column_key] = $this->getFormattedValue("{$cell_column}{$cell_row}");

				//$test["{$cell_column}{$cell_row}"] = $this->getFormattedValue("{$cell_column}{$cell_row}");
			}
		}
		
		//pd($this->getFormattedValue("I21"));
		//pd($this->data);
		//dd($test);
	}
}
