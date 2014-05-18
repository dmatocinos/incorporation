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

		if ($notification = Session::get('notification')) {
			View::share('notification', $notification);
		}
	}
	
	public static function saveParamsToSession($data) 
	{
		$date = new DateTime();
		$timestamp = $date->getTimestamp();
		
		Session::put('subscription_data_' . $timestamp, base64_encode(http_build_query($data)));
		
		return $timestamp;
	}
	
	public static function getParamsFromSession($timestamp) 
	{
		$params = base64_decode(Session::get('subscription_data_' . $timestamp));
		parse_str($params, $data);
		
		return $data;
	}
	
	public static function forgetParams($timestamp) 
	{
		Session::forget('subscription_data_' . $timestamp);
	}

	public function sendEmailSupport()
	{
		$data = Input::all();
		$user = Auth::user()->practice_pro_user;
		$subject = $data['subject'];
		Mail::send('emails.support', ['msg' => $data['msg']], function($message) use ($user, $subject)
		{
			$message->to(
				//'dixie.atay@gmail.com', 
				'support@practicepro.co.uk', 
				'Support Team'
			)->subject('Incorporation Pro - ' . $subject);

			$message->from($user->mh2_email, sprintf("%s %s", $user->mh2_fname, $user->mh2_lname));
		});

		return Redirect::back()->with('notification', ['type' => 'success', 'text' => 'You have successfully sent your message to support team.']);
	}
}
