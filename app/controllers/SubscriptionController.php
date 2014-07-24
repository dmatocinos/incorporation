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

		if ( ! $pricing) {
			throw new Exception("Unknown membership level: {$this->user->practice_pro_user->membership_level}");
		}

		$business_entity = Input::old('business_entity');

		$paypal_data = array(
			'amount' 	=> $pricing->getDiscountedAmount(),
			'description'	=> Config::get('paypal.description') . " Payment for {$business_entity}",
			'returnUrl'	=> url('complete_payment', array($timestamp)),
			'cancelUrl'	=> url('cancel_payment', array($timestamp)),
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
		
		$timestamp = BaseController::saveParamsToSession($data);
		
		$pricing    = $this->user->practice_pro_user->pricing;
		if ($pricing->is_free) {
			return Redirect::route('complete_subscription');
		}

		$amount     = $pricing->getAmount();
		$discount   = $pricing->discount * 100;
		$discounted = $pricing->getDiscountedAmount();
		$level      = $this->user->practice_pro_user->membership_level;
		$display    = $this->user->practicepro_user->membership_level_display;

		$msg = sprintf("As a %s Member of PracticePro", $display);
		$suffix = "However you will get a full refund if you embark on a tax strategy.";
		
		if ($discount > 0) {
			$msg .= ", you are entitled to a " . $discount . "% discount of all software, and therefore your {$display} preferential price is only &pound" . number_format(round($discounted, 2), 2) . " per valuation";

			if ($display == 'Pro Active') {
				$upgrade_link = link_to('http://www.practicepro.co.uk/package-comparison/', 'here');
				$msg .= "<br><br> You can receive an even more incentive with Incorporation by upgrading to a Professional subscription. <br> Click {$upgrade_link} to learn more about the benefits of upgrading.”";
			}
		}
		else {
			$msg .= " you are required to pay an amount of &pound" . number_format(round($amount, 2), 2) . " to fully manage the report.";

			$upgrade_link = link_to('http://www.practicepro.co.uk/package-comparison/', 'here');
			$msg .= "<br><br> You can receive more incentive with Incorporation by upgrading your subscription. <br> Click {$upgrade_link} to learn more about the benefits of upgrading.”";
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
		return Redirect::to("business/new?s_timestamp=" . $timestamp)->withInput();
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
				$next_page = (isset($input['save_next_page'])) ? 'summary' : 'business';

				$business = Business::saveBusiness($input);

				$payment_data = array(
                    'business_id'    => $business->id,
                    'amount'         => $transaction_data['PAYMENTINFO_0_AMT'],
                    'transaction_id' => $transaction_data['PAYMENTINFO_0_TRANSACTIONID'],
                    'order_time'     => $transaction_data['PAYMENTINFO_0_ORDERTIME']
				);

				$payment = Payment::create($payment_data);
				$payment->save();

				BaseController::forgetParams($timestamp);

				return Redirect::to($next_page . '/' . $business->id)->with('message', 'Successfully saved changes.');
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
