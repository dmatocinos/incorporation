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
        
        if ($this->business->isPartnership()) {
            $columns = array(
                'partnership'	=> 'F'
            );
         }
        else {
            $columns = array(
                'sole_trade'	=> 'D'
            );
        }

		$test = array();
		
		foreach ($rows as $row_key => $cell_row) {
			foreach ($columns as $column_key => $cell_column) {
                if ($row_key == 'net_in_pocket') {
                    $val = $this->getFormattedValue("{$cell_column}{$cell_row}");
                    $this->data['net_in_pocket_total'][$column_key] = $this->formatNumberToDecimalPlaces($val, 2);
                    
                    $val = $this->getCalculatedValue("{$cell_column}{$cell_row}");
                    $val = $val / $this->business->number_of_partners;
                }
                else {
                    $val = $this->getFormattedValue("{$cell_column}{$cell_row}");
                }
                
				$this->data[$row_key][$column_key] = $this->formatNumberToDecimalPlaces($val, 2);

				//$test["{$cell_column}{$cell_row}"] = $this->getFormattedValue("{$cell_column}{$cell_row}");
			}
		}
//	echo '<pre>';	
//dd($this->getFormattedValue('D16'), $this->getFormattedValue('K17'), $this->getFormattedValue('F17'), $this->getFormattedValue('H32'), $this->getFormattedValue('G25'), $this->getFormattedValue('K3'), $this->getFormattedValue('J3'), $this->getFormattedValue('J4'));
		//pd($this->getFormattedValue("H14"));
		//pd($this->data);
		//dd($test);
	}
}
