<?php

class SummaryTotalSavingsService extends IncorporationEngine {
    protected $comparison;
    
    public function __construct(Business $business, array $comparison)
    {
        $this->comparison = $comparison;
        parent::__construct($business);
    }
    
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
            if ($column == 'bpk_fee_first_year_only') {
                $val = $this->getformattedvalue("{$cell_column}{$row}");
                
                if ($this->getFloatValFromString($val) <= 0) {
                    $this->data[$column] = '0';
                    continue;
                }
            }
            
			$this->data[$column] = $this->formatNumberToDecimalPlaces($this->getformattedvalue("{$cell_column}{$row}"), 2);
            $this->data[$column . '_calculated'] = $this->getCalculatedValue("{$cell_column}{$row}");
		}
        
        $business = $this->business;
        
        $total_tax_as_incorporated = $business->isPartnership() ? $this->comparison['total_to_hmrc']['partnership_calculated'] : $this->comparison['total_to_hmrc']['sole_trade_calculated'];
        $total_annual_tax_savings = ($business->isPartnership() ? $this->data["total_tax_as_a_partnership_calculated"] : $this->data["total_tax_as_a_sole_trader_calculated"]) - $total_tax_as_incorporated;
        $bpk_fee_first_year_only = $total_annual_tax_savings * ($business->fee_based_on_tax_saved / 100);
        
        $this->data['total_tax_as_incorporated'] = $this->formatNumberToDecimalPlaces($total_tax_as_incorporated, 2);
        $this->data['total_annual_tax_savings'] = $this->formatNumberToDecimalPlaces($total_annual_tax_savings, 2);
        $this->data['bpk_fee_first_year_only'] = ($bpk_fee_first_year_only <= 0) ? '0' : $this->formatNumberToDecimalPlaces($bpk_fee_first_year_only, 2);
	}
}
