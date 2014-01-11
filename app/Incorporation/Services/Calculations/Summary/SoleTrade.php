<?php namespace Incorporation\Services\Calculations\Summary;

use \Partner as Partner;

/**
 * @author Belmark June Caday <cadaybelmark@gmail.com>
 */

class SoleTrade extends Engine{

/**
	 * The partner object to calculate the salary in limited
	 * corporation for
	 *
	 * @var Partner
	 */
	protected Partner $partners;
	protected $data;
	
	protected function init(){
	
		$this->column_rows = array(
			'corporation_tax'	=> 28,
			'income_tax'		=> 29,
			'employers_ni'		=> 32,
			'employees_ni'		=> 33,
			'total_to_hmrc'		=> 35,
			'net_in_pocket'		=> 37,
			'left_in_company'	=> 38,
			'amount_retained'	=> 40,
		);
	
		$this->data = array();
		
		foreach( $column_rows as $column => $row){
		
			$cell_column = 'D'; //Column D in the excel
			
			$this->data[$column] = $this->getCalculatedValue("{$cell_column}{$row}");
		}
	}

}

?>