<?php namespace Incorporation\Services\Calculations\Results;

use \Partner as Partner;

/**
 * @author Leonel Tomes <mr.leonel.tomes@gmail.com>
 */
class SalaryInLimitedCo {

	/**
	 * The partner object to calculate the salary in limited
	 * corporation for
	 *
	 * @var Partner
	 */
	protected Parnter $partners;
	protected $data;
	
	protected function init(){
	
		$this->column_rows = array(
			'taxable_1'		=> 20,
			'taxable_2'		=> 21,
			'taxable_3'		=> 22,
			'taxable_4'		=> 23,
			'taxable_5'		=> 24,
			'taxable_ni'	=> 25,
			'ni_due_1'		=> 26,
			'ni_due_2'		=> 27,
			'total_tax'		=> 29,
			'sum'			=> 30,
			'net_pocket'	=> 31
		);
	
		$this->data = array();
		
		foreach( $column_rows as $column => $row){
		
			$cell_column = 'P';
			
			foreach( $this->partners as $partner ){
				$this->data[$column][$partner->id] = $this->getCalculatedValue("{$cell_column}{$row}");
				$cell_column++;
			}
		}
	}
}
