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
	protected $partner;

	/**
	 *
	 * @param  Partner $partner
	 */
	public function __construct(Partner $partner)
	{
		$this->partner = $partner;

		$option = $this->partner->business->option;

		$this->F17	= $this->partner->salary;
		$this->K6	= $option->employers_ni_k;
		$this->K8	= $option->k8;
		$this->J5	= $option->employees_ni_j;
		$this->J7	= $option->income_tax_and_ni_j;
		$this->J8	= $option->j8;
		$this->K9	= $option->k9;
		$this->L5	= $option->employees_ni_l;
		$this->I5	= $option->employees_ni_i;

		$this->P20	= $this->getTaxable1();
		$this->P24	= $this->getTaxable5();
		$this->P25	= $this->getTaxableNI();
	}

	/**
	 *
	 * @return numeric
	 */
	public function getTaxable1()
	{
		if ($this->F17 < $this->K6) {
			return 0;
		}
			
		if ($this->F17 < 100000) {
			return $this->F17 - $this->K6;
		}

		if ($this->F17 >= 100000) {
			return $this->F17;
		}
	}

	/**
	 *
	 * @return numeric
	 */
	public function getTaxable2()
	{
		if ($this->P20< $this->K8) {
			return $this->P20 * $this->J7;
		}
		
		if ($this->P20 > $this->K8) {
			return 0;
		}

		return NULL;
	}

	/**
	 *
	 * @return numeric
	 */
	public function getTaxable3()
	{
		if ($this->P20 < $this->K8) {
			return 0;
		}

		if ($this->P20 >= $this->K9) {
			return 0;
		}

		if ($this->P20 < $this->K9) {
			return (($this->P20 - $this->K8) * $this->J8) + ($this->K8 * $this->J7);
		}

		return NULL;
	}

	/**
	 *
	 * @return numeric
	 */
	public function getTaxable4()
	{
		if ($this->P20 == 0) {
			return 0;
		}
		if ($this->P20 >= $this->K9) {
			return $this->P24;
		}
		else {
			return 0;
		}
	}

	/**
	 *
	 * @return numeric
	 */
	public function getTaxable5()
	{
		if ($this->P20 > $this->K9) {
			return ((($this->P20-$this->K9) * $this->J9) + (($this->K9-$this->K8) * $this->J8) + ($this->K8 * $this->J7));
		}
		else {
			return 0;
		}
	}

	/**
	 *
	 * @return numeric
	 */
	public function getTaxableNI()
	{
		if ($this->F17 < $this->K6) {
			return 0;
		}
		else {
			return $this->F17 - $this->K6;
		}
	}

	/**
	 *
	 * @return numeric
	 */
	public function getNIDue1()
	{
		if ($this->P25 < $this->L5) {
			return $this->P25 * $this->J5;
		}
		
		if ($this->P25 > $this->L5) {
			return 0;
		}

		return NULL;
	}

	/**
	 *
	 * @return numeric
	 */
	public function getNIDue2()
	{
		if ($this->P25 > $this->L5) {
			(($this->P25 - $this->L5) * $this->I5) + ($this->L5 * $this->J5);
		}
		else {
			return 0;
		}
	}

	/**
	 *
	 * @return numeric
	 */
	public function getTotalTax()
	{
		//=SUM(P21:P23)+SUM(P26:P27)

		return $this->getTotalTaxable() + $this->getTotalNIDue();
	}

	/**
	 *
	 * @return numeric
	 */
	protected function getTotalTaxable()
	{
		return $this->getTaxable2() + $this->getTaxable3() + $this->getTaxable4();
	}

	/**
	 *
	 * @return numeric
	 */
	protected function getTotalNIDue()
	{
		return $this->getNIDue1() + $this->getNIDue2();
	}

}
