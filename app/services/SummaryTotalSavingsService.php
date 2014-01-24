<?php

class SummaryTotalSavingsService extends IncorporationEngine {

	protected function init()
	{
		$column_rows = array(
			'total_tax_as_a_sole_trader'			=> 47,
			'total_tax_as_a_partnership'			=> 48,
			'total_tax_with_salary_in_ltd_co'		=> 49,
			'total_tax_with_dividends_in_ltd_co'		=> 50,
			'total_yearly_tax_savings_by_changing'		=> 52,
			'bpk_fee_first_year_only'			=> 54
		);

		$cell_column = 'H';

		foreach ($column_rows as $column => $row) {
			$this->data[$column] = $this->getformattedvalue("{$cell_column}{$row}");
		}
	}
}
