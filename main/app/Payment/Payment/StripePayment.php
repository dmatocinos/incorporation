<?php namespace Payment\Payment;
 
use Stripe;
use Stripe_Charge;
use Stripe_Customer;
use Stripe_InvalidRequestError;
use Stripe_CardError;
use Config;
 
class StripePayment implements PaymentInterface {
    public function __construct()
    {
        Stripe::setApiKey(Config::get('stripe.secret_key'));
    }
 
    public function charge(array $data)
    {
        try
        {
            return Stripe_Charge::create([
                'card'        => $data['token'], //will grab the stripe-token stripe.js generates
                'amount'      => $data['amount'] * 100, // this is in cents.
                'currency'    => Config::get('stripe.currency'),
                'description' => $data['email']
            ]);
        }
        catch (Stripe_CardError $e)
        {
            return "card was declined";
            // Card did not work
        }
        catch(Stripe_InvalidRequestError $e)
        {
            return 'Error with payment processor. Please contact us.';
            // bad API
        }
    }
}