<?php

class AuthorizedController extends BaseController {

	protected $business;

	public function __construct()
	{
		parent::__construct();

		$this->business = Business::first();
	}
}
