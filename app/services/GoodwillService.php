<?php

class GoodwillService {
	
	protected $excel_engine;
	protected $reporter;
	
	public function __construct(Business $business)
	{
		$this->excel_engine = new GoodwillEngine($business);
		$this->reporter = new GoodwillReporter($business, $this->excel_engine);
	}

	public function __get($name)
	{
		return $this->$name;
	}

}
