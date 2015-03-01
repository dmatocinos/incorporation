<?php

class SummaryComparisonServiceProRebuild extends IncorporationEngineProRebuild{
    protected function init()
	{
        $this->getEngine()->setActiveSheetIndex(1);

		$rows = array(
			'corporation_tax'           => 8,
			'income_tax'                => 9,
            'class2'                    => 12,
            'class4'                    => 13,
			'employee'                  => 14,
			'employer'                  => 15,
			'total_to_hmrc'	            => 19,
			'net_in_pocket'	            => 21,
			'net_in_pocket_per_partner' => 23
		);
        
        if ($this->business->isPartnership()) {
            $columns = array(
                'entity'	           => 'H',
                'limited_company'      => 'I',
                'better_off_each_year' => 'J'
            );
         }
        else {
            $columns = array(
                'entity'	           => 'C',
                'limited_company'      => 'D',
                'better_off_each_year' => 'E'
            );
        }
        
        foreach ($rows as $row_key => $cell_row) {
			foreach ($columns as $column_key => $cell_column) {
				$this->data[$column_key][$row_key] = $this->formatNumberToDecimalPlaces($this->getFormattedValue("{$cell_column}{$cell_row}"), 2);
                $this->data[$column_key][$row_key . '_calculated'] = $this->getCalculatedValue("{$cell_column}{$cell_row}");
            }
		}
	}
}
