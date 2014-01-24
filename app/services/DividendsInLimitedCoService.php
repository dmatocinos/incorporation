<?php

class DividendsInLimitedCoService extends IncorporationEngine {

	protected function init() {
	
		$column_rows = array(
			'taxable_dividends'		=> 36,
			'tax_credit'			=> 37,
			'10%_dividends'			=> 39,
			'32.5%_dividends'		=> 40,
			'42.5%_dividends_1'		=> 41,
			'42.5%_dividends_2'		=> 42,
			'total_tax_dividends'		=> 46,
			'total_tax_dividends_sum'	=> 47,
			'net_in_pocket'			=> 48
		);
		
		foreach ($column_rows as $column => $row) {
			if ($column == 'total_tax_dividends_sum') {
				$cell_column = 'T';
				$this->data[$column][$partner->id] = $this->getFormattedValue("{$cell_column}{$row}");
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

?>
