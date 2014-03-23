<?php

use \Omnipay\Common\GatewayFactory;
use \Carbon\Carbon;

class SubscriptionController extends AuthorizedController {

	protected $user;

	public function __construct()
	{
		parent::__construct();

		$this->user = Auth::user();
	}

	// @todo move to service
	protected function getGateway()
	{
		$gateway = new GatewayFactory();
		$gateway = $gateway->create(Config::get('paypal.gateway'));

		$gateway->setUsername(Config::get('paypal.username'));
		$gateway->setPassword(Config::get('paypal.password')); 
		$gateway->setSignature(Config::get('paypal.signature'));
		$gateway->setTestMode(Config::get('paypal.test_mode'));

		return $gateway;
	}

	// @todo move to service
	protected function getPurchaseData()
	{
		$pricing = $this->user->practice_pro_user->pricing;
		/*
		var_dump(DB::connection('practicepro_users')->getQueryLog());
		var_dump(DB::connection()->getQueryLog());
		die();
		 */
		if ( ! $pricing) {
			throw new Exception("Unknown membership level: {$this->user->practice_pro_user->membership_level}");
		}

		$expiration_date = $pricing->getNewSubscriptionExpiration($this->user)->toFormattedDateString();

		$paypal_data = array(
			'amount' 	=> $pricing->getDiscountedAmount(),
			'description'	=> Config::get('paypal.description') . " Payment Until {$expiration_date}",
			'returnUrl'	=> route('complete_payment', array($this->user->id)),
			'cancelUrl'	=> route('cancel_payment', array($this->user->id)),
			'currency'	=> Config::get('paypal.currency')
		);

		return $paypal_data;
	}

	/**
	 * Show the PayPal payment screen
	 *
	 */
	public function subscribe()
	{
		$pricing    = $this->user->practice_pro_user->pricing;
		$amount     = $pricing->getAmount();
		$discount   = $pricing->discount * 100;
		$discounted = $pricing->getDiscountedAmount();
		$level      = $this->user->practice_pro_user->membership_level;
		
		switch ($this->user->practice_pro_user->membership_level) {
			case 'Tax Club':
				$msg = "As a Tax Club Member of PracticePro";
				break;
				
			case 'Elite Member':
				$msg = "As an Elite Member of PracticePro";
				
				break;
			
			case 'Pay as you go':
			default:
				$msg = "As a Pay as you go member of PracticePro";
				
				break;
		}
		
		if ($pricing->is_free) {
			return Redirect::to("/")->withMessage('You have successfully subscribed.');
		}
		else if ($discount > 0) {
			$msg .= ", we are giving you a special " . $discount . "% discount.  You only have to pay &pound" . number_format(round($discounted, 2), 2) . ". Don't let this offer pass!";
		}
		else {
			$msg = "You can subscribe for only &pound" . number_format(round($amount, 2), 2) . ".";
		}
		
		$data = array(
			'msg' => $msg
		);
		
		return View::make("subscription.subscribe", $data);
	}
	
	public function startPayment() {
		$gateway = $this->getGateway();

		try {
			$response = $gateway->purchase($this->getPurchaseData())->send();
			if ($response->isRedirect()) {
				// it should redirect to PayPal payment page
				$response->redirect();
			} 
			else {
				throw new Exception($response->getMessage());
			}
		} 
		catch (Exception $e) {
			throw $e;
		}
	}

	public function cancelPayment()
	{
		return Redirect::route("subscribe");
	}

	public function completePayment($user_id)
	{
		$user = User::findOrFail($user_id);

		$gateway = $this->getGateway();

		try {
			$response = $gateway->completePurchase($this->getPurchaseData())->send();
			if ($response->isSuccessful()) {
				$pricing = $user->practice_pro_user->pricing;
				$user->valid_until = $pricing->getNewSubscriptionExpiration($user);
				$user->save();

				return Redirect::route("valuations")->withMessage('You have successfully subscribed to BizValuation.');
			} 
			else {
				throw new Exception($response->getMessage());
			}
		} 
		catch (Exception $e) {
			throw $e;
		}
	}

	public function completeSubscription()
	{
		//
	}

}
