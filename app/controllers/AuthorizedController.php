<?php

class AuthorizedController extends BaseController {

	public function __construct()
	{
		$this->beforeFilter(function($route, $request) {
			$business_id = $route->getParameter('business_id');
			
			if (is_numeric($business_id)) {
				$this->business = Business::find($business_id);
			}
		});
		
		parent::__construct();
	}
}
