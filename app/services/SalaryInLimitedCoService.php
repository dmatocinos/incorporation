<?php

class SalaryInLimitedCoService extends IncorporationEngine {

	protected function init()
	{
		$column_rows = array(
			'taxable_tax_1'		=> 20,
			'taxable_tax_2'		=> 21,
			'taxable_tax_3'		=> 22,
			'taxable_tax_4'		=> 23,
			'taxable_tax_5'		=> 24,
			'taxable_ni'		=> 25,
			'ni_due_1'		=> 26,
			'ni_due_2'		=> 27,
			'total_tax_ltd_co'	=> 29,
			'total_tax_ltd_co_sum'	=> 30,
			'net_in_pocket'		=> 31
		);
	
		foreach ($column_rows as $column => $row) {
			if ($column == 'total_tax_ltd_co_sum') {
				$cell_column = 'T';
				$this->data[$column][$partner->id] = $this->getformattedvalue("{$cell_column}{$row}");
			}
			else {
				$cell_column = 'P';
			
				foreach ($this->business->partners as $partner) {
					$this->data[$column][$partner->id] = $this->getFormattedValue("{$cell_column}{$row}");
					$cell_column++;
				}
			}
		}
	}

}
