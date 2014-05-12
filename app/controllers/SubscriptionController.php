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
	protected function getPurchaseData($timestamp)
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

		$business_entity = Input::old('business_entity');

		$paypal_data = array(
			'amount' 	=> $pricing->getDiscountedAmount(),
			'description'	=> Config::get('paypal.description') . " Payment for {$business_entity}",
			'returnUrl'	=> route('complete_payment', $timestamp),
			'cancelUrl'	=> route('cancel_payment', $timestamp),
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
		$data = Input::old();
		
		unset($data['_method']);
		unset($data['_token']);
		
		$timestamp = BaseController::saveParamsToSession($data);
		
		$pricing    = $this->user->practice_pro_user->pricing;
		if ($pricing->is_free) {
			return Redirect::route('complete_subscription');
		}

		$amount     = $pricing->getAmount();
		$discount   = $pricing->discount * 100;
		$discounted = $pricing->getDiscountedAmount();
		$level      = $this->user->practice_pro_user->membership_level;

		$msg = sprintf("As a %s Member of PracticePro", $this->user->practice_pro_user->membership_level_display);
		
		if ($discount > 0) {
			$msg .= ", we are giving you a special " . $discount . "% discount.  You only have to pay &pound" . number_format(round($discounted, 2), 2) . ". Don't let this offer pass!";
		}
		else {
			$msg = "You can continue creating this report for only &pound" . number_format(round($amount, 2), 2) . ".";
		}
		
		$data = array(
			'msg'	=> $msg,
			'timestamp' => $timestamp
		);

		return View::make("subscription.subscribe", $data);
	}
	
	public function startPayment($timestamp) 
	{
		Session::reflash();

		$gateway = $this->getGateway();

		try {
			$response = $gateway->purchase($this->getPurchaseData($timestamp))->send();
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

	public function cancelPayment($timestamp)
	{
		return Redirect::to("create?s_timestamp=" . $timestamp);
	}

	public function completePayment($timestamp)
	{
		$user = $this->user;

		$gateway = $this->getGateway();

		try {
			$response = $gateway->completePurchase($this->getPurchaseData($timestamp))->send();
			if ($response->isSuccessful()) {
				$input    = BaseController::getParamsFromSession($timestamp);
				$transaction_data = $response->getData();
                $partners = $input['partners'];
                $next_page = (isset($input['save_and_next_button'])) ? 'results' : 'update';
                
                unset($input['_token']);
                unset($input['_mthod']);
                unset($input['number_of_partners']);
                unset($input['partners']);
                unset($input['save_button']);
                unset($input['save_and_next_button']);
                $input['user_id'] = Auth::user()->id;
                
                $business = new Business();
                
                $business->fill($input);
                $business->save();
                $business->setPartners($partners
				
				$payment_data = array(
					'business_id'    => $business->id,
					'amount'         => $transaction_data['PAYMENTINFO_0_AMT'],
					'transaction_id' => $transaction_data['PAYMENTINFO_0_TRANSACTIONID'],
					'order_time'     => $transaction_data['PAYMENTINFO_0_ORDERTIME']
				);
				
				$payment = Payment::create($payment_data);
				$payment->save();
				
				BaseController::forgetParams($timestamp););
                
                return Redirect::to($next_page . '/' . $business->id);
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
	}

}
