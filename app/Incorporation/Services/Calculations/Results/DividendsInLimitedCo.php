<?php namespace Incorporation\Services\Calculations\Results;

use \Partner as Partner;

/**
 * @author Belmark June Caday <cadaybelmark@gmail.com>
 */

class DividendsInLimitedCo extends Engine{

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
			'taxable'					=> 36,
			'tax_credit'				=> 37,
			'10_percent_dividends'		=> 39,
			'32.5_percent_dividends'	=> 40,
			'42.5_percent_dividends_1'	=> 41,
			'42.5_percent_dividends_2'	=> 42,
			'total_tax_divs'			=> 46,
			'sum'						=> 47,
			'net_in_pocket'				=> 48
		);
		
		$this->data = array();
		
		foreach( $column_rows as $column => $row ){
			$cell_column = 'P';
			
			foreach( $this->partners as $partner ) {
				$this->data[$column][$partner->id] = $this->getCalculatedValue("{$cell_column}{$row}");
				$column++;
			}
		}
	}

?>