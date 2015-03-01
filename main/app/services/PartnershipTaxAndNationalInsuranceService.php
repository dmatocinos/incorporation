<?php

class PartnershipTaxAndNationalInsuranceService extends IncorporationEngine {
	
	protected function init() {
	
		$column_rows = array(
			'taxable_tax'			=> 6,
			'tax_due_1'			=> 7,
			'tax_due_2'			=> 8,
			'tax_due_3'			=> 9,
			'tax_due_4'			=> 10,
			'taxable_ni'			=> 11,
			'ni_due_1'			=> 12,
			'ni_due_2'			=> 13,
			'total_tax_partnership'		=> 15,
			'total_tax_partnership_sum'	=> 16
		);
		
		foreach ($column_rows as $column => $row) {
			if ($column == 'total_tax_partnership_sum') {
				$cell_column = 'T';
				$this->data[$column][$partner->id] = $this->formatNumberToDecimalPlaces($this->getFormattedValue("{$cell_column}{$row}"), 2);
			}
			else {
				$cell_column = 'P';
			
				foreach ($this->business->partners as $partner) {
					$this->data[$column][$partner->id] = $this->formatNumberToDecimalPlaces($this->getFormattedValue("{$cell_column}{$row}"), 2);
					$cell_column++;
				}
			}
		}
	}
}

?>
