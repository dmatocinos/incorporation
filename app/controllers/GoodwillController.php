<?php

use \Omnipay\Common\GatewayFactory;

class GoodwillController extends AuthorizedController {
	
	protected $responsereturn;
	
	public function show()
	{
		$service = new GoodwillService($this->business);
		$goodwill_data = $service->excel_engine->getData();

		return View::make('goodwill.show', ['business' => $this->business, 'data' => $goodwill_data, 'paypal_success' => Session::get('paypal_success')]);
	}

	public function download()
	{
		$business = $this->business;

		$service = new GoodwillService($this->business);
		$service->reporter->generate($service->excel_engine->getData());
	}

	public function goodwillPayment()
	{
		$gateway = new GatewayFactory();
		$gateway = $gateway->create('PayPal_Express');

		$gateway->setUsername('sandbox_dxc_bus_api1.test.com'); 
		$gateway->setPassword('1392007298'); 
		$gateway->setSignature('AiPC9BjkCyDFQXbSkoZcgqH3hpacAHEN5-o4LIjnhECPR825QdHT95XE');
		$gateway->setTestMode('true');

		$paypal_data = array(
			'amount' 	=> '1.00',
			'description'	=> 'Your purchase',
			'returnUrl'	=> 'http://practicepro.co.uk/incorporation/public/index.php/goodwill/paypal_return/' . $this->business->id,
			'cancelUrl'	=> 'http://practicepro.co.uk/incorporation/public/index.php/goodwill/paypal_cancel/' . $this->business->id,
			'currency'	=> 'USD'
		);

		try {
			$response = $gateway->purchase($paypal_data)->send();
			if ($response->isSuccessful()) {
				// mark order as complete
				$responsereturn = $response->getData();
			} 
			elseif ($response->isRedirect()) {
				$response->redirect();
			} 
			else {
				// display error to customer
				exit($response->getMessage());
			}
		} 
		catch (Exception $e) {
			exit($e->getMessage());
			// internal error, log exception and display a generic message to the customer
		//	exit('Sorry, there was an error processing your payment. Please try again later.');
		}


	}

	public function cancelPayment()
	{
		
	}

	public function returnPayment()
	{
		$this->business->has_goodwill = TRUE;
		$this->business->update();

		return Redirect::to("goodwill/{$this->business->id}")->with('paypal_success', TRUE);
	}


}
