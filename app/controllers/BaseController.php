<?php

class BaseController extends Controller {

	/**
	 *
	 * @var Session
	 */
	protected $redirect;

	/**
	 *
	 * @var Session
	 */
	protected $session; 

	/**
	 *
	 * @var View
	 */
	protected $view;

	/**
	 *
	 * @var Request
	 */
	protected $request;

	/**
	 *
	 * @var Validator
	 */
	protected $validator;

	/**
	 * Initializer. All objects needed to make the
	 * controller work should be added on here.
	 *
	 */
	public function __construct()
	{
		//parent::__construct();

		$this->session = App::make('session');
		$this->redirect = App::make('redirect');
		$this->view = App::make('view');
		$this->request = App::make('request');
		$this->validator = App::make('validator');

		// @todo add csrf before filter
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
