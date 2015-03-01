<?php

class SubscriptionController extends AuthorizedController {

	protected $user;

	public function __construct()
	{
		parent::__construct();

		$this->user = Auth::user();
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
			$msg .= "<br><br> You can receive more incentive with Incorporation by upgrading your subscription. <br> Click {$upgrade_link} to learn more about the benefits of upgrading.";
		}
		
		$data = array(
			'msg'	    => $msg,
			'timestamp' => $timestamp,
            'email'     => $data['email']
		);
        
        Asset::container('footer')->add('jquery-js', 'assets/js/jquery-1.10.2.js');
        Asset::container('footer')->add('payment-js', 'assets/js/payment/stripe.js');

		return View::make("payment.index", $data);
	}
	
	public function cancelPayment($timestamp)
	{
		return Redirect::to("business/new?s_timestamp=" . $timestamp)->withInput();
	}

	public function completePayment()
	{
		$user = $this->user;

        App::bind('Payment\Payment\PaymentInterface', 'Payment\Payment\StripePayment');

        $payment    = App::make('Payment\Payment\PaymentInterface');
        $pricing    = $this->user->practice_pro_user->pricing;
        $discounted = $pricing->getDiscountedAmount();
        $data       = ['token'  => Input::get('stripe-token'), 'amount' => $discounted, 'email' => Input::get('email')];
        $token      = $payment->charge($data);
        $timestamp  = Input::get('timestamp');
        $input      = BaseController::getParamsFromSession($timestamp);
		$next_page  = (isset($input['save_next_page'])) ? 'summary' : 'business';
		$business   = Business::saveBusiness($input);

        $payment_data = array(
            'business_id'    => $business->id,
            'amount'         => $discounted,
            'transaction_id' => $token->id,
            'order_time'     => date('Y-m-d H:i:a')
        );

		$payment = Payment::create($payment_data);
		$payment->save();

		BaseController::forgetParams($timestamp);

 	    return Redirect::to($next_page . '/' . $business->id)->with('message', 'Successfully saved changes.');
	}
}
