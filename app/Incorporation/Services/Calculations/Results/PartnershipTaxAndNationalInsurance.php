<?php namespace Incorporation\Services\Calculations\Results;

use \Partner as Partner;

/**
 * @author Belmark June Caday <cadaybelmark@gmail.com>
 */

class PartnershipTaxAndNationalInsurance extends Engine{
	/**
	 * The partner object to calculate the salary in limited
	 * corporation for
	 *
	 * @var Partner
	 */
	protected Partner $partners;
	protected $data;
	
	protected function init() {
	
		$this->column_rows = array(
			'taxable'			=> 6,
			'tax_due_1'			=> 7,
			'tax_due_2'			=> 8,
			'tax_due_3'			=> 9,
			'tax_due_4'			=> 10,
			'taxable_ni'		=> 11,
			'ni_due'			=> 12,
			'sum_per_partner'	=> 13,
			'total_tax'			=> 15,
			'sum_of_total_tax'	=> 16
		);
		
		$this->data = array();
		
		foreach( $column_rows as $column => $row ){
			$cell_column = 'P';
			
			foreach( $this->partners as $partner ) {
				$this->data[$column][$partner->id] = $this->getCalculatedValue("{$cell_column}{$row}");
				$cell_column++;
			}
		}
	}
}

?>