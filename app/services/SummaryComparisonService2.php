<?php

class SummaryComparisonService2 extends IncorporationEngine2 {
    protected function init()
	{
		$rows = array(
			'corporation_tax'     => 120,
			'income_tax'          => 121,
			'employer'            => 124,
			'employee'            => 125,
			'total_to_hmrc'	      => 127,
			'net_in_pocket'	      => 129,
			'net_in_pocket_total' => 131
		);
        
        if ($this->business->isPartnership()) {
            $columns = array(
                'partnership'	=> 'J'
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
				$this->data[$row_key][$column_key] = $this->formatNumberToDecimalPlaces($this->getFormattedValue("{$cell_column}{$cell_row}"), 2);
                $this->data[$row_key][$column_key . '_calculated'] = $this->getCalculatedValue("{$cell_column}{$cell_row}");
            }
		}
//	echo '<pre>';	
//dd($this->getFormattedValue('D16'), $this->getFormattedValue('K17'), $this->getFormattedValue('F17'), $this->getFormattedValue('H32'), $this->getFormattedValue('G25'), $this->getFormattedValue('K3'), $this->getFormattedValue('J3'), $this->getFormattedValue('J4'));
		//pd($this->getFormattedValue("H14"));
		//pd($this->data);
		//dd($test);
	}
}
