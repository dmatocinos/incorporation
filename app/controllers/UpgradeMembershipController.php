<?php

use \Omnipay\Common\GatewayFactory;
use \Carbon\Carbon;

class UpgradeMembershipController extends BaseController {

	protected $user;
	protected $business_id;
	protected $layout = 'layouts.subscribe';

	public function __construct()
	{
		parent::__construct();

		$this->user = Auth::user();
		$this->business_id = Session::get('download_business_id');
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
	protected function getPurchaseData($level)
	{
		$pricings = Config::get('paypal.package_pricings');
		$now = Carbon::now();

		$paypal_data = array(
			'amount' 	=> $pricings[$level],
			'description'   => sprintf("%s (%s) Payment on %s", 'Practice Pro Upgrade ', $this->user->practice_pro_user->getMembershipLevelDisplayByKey($level), $now->toFormattedDateString()),
			'returnUrl'	=> url('upgrade/complete_payment', $level),
			'cancelUrl'	=> url('upgrade/cancel_payment'),
			'currency'	=> Config::get('paypal.currency')
		);

		return $paypal_data;
	}

	/**
	 * Show the PayPal payment screen
	 *
	 */
	public function upgrade()
	{
		$msg = sprintf("As a %s Member of PracticePro, ", $this->user->practice_pro_user->membership_level_display);
		$msg .= "you can only download up to {$this->user->practice_pro_user->getLimit()} reports for Incorporation and Biz Valuation.";
		
		if (($level = $this->user->practice_pro_user->getMembershipLevelDisplayAttribute()) != 'Professional') {
			$msg .= '<br><br> Upgrade to higher membership level to download more reports.';
		}

		$data = array(
			'msg'   => $msg,
			'level' => $level,
		);
		
		$this->layout->content = View::make("user.upgrade", $data);
	}
	
	public function startPayment($level) 
	{
		$gateway = $this->getGateway();
		try {
			$response = $gateway->purchase($this->getPurchaseData($level))->send();
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
		return Redirect::to("summary/{$this->business_id}/")->withInput();
	}

	public function completePayment($level)
	{
		$gateway = $this->getGateway();

		try {
			$response = $gateway->completePurchase($this->getPurchaseData($level))->send();
			
			if ($response->isSuccessful()) {
				try {
					DB::beginTransaction();
					
					$transaction_data = $response->getData();
					
					$payment_data = array(
						'amount'         => $transaction_data['PAYMENTINFO_0_AMT'],
						'transaction_id' => $transaction_data['PAYMENTINFO_0_TRANSACTIONID'],
						'order_time'     => $transaction_data['PAYMENTINFO_0_ORDERTIME']
					);
					
					$this->user->practice_pro_user->payment($payment_data);
					$this->user->practice_pro_user->upgradeMembershipLevel($level);
					
					DB::commit();

					$user = $this->user->practice_pro_user;
					// Send email to the user
					Mail::send('emails.upgrade_success', ['user' => $user], function($message) use ($user)
					{
						$from = Config::get('mail.from');
						$message->to(
							$user->mh2_email, 
							sprintf("%s %s", $user->mh2_fname, $user->mh2_lname)
						)->subject('Practice Pro Membership Upgrade');
						
						$message->from($from['address'], $from['name']);
					});

					// send email to practicepro admin
					Mail::send('emails.upgrade_member_reminder', ['user' => $user], function($message)  use ($user)
					{ 
						$from = Config::get('mail.from');
						$to   = Config::get('mail.admin_email');

						$message->to($to['address'], $to['name'])->subject('Membership Upgrade!');
						$message->from($from['address'], $from['name']);
					});
					return Redirect::to("report/incorporation/{$this->business_id}");
				}
				catch (Exception $e) {
					DB::rollback();
					throw $e;
				}
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
