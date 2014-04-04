<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Payment Gateway
	|--------------------------------------------------------------------------
	|
	*/

	'gateway' => 'PayPal_Express',

	/*
	|--------------------------------------------------------------------------
	| Payment Currency
	|--------------------------------------------------------------------------
	|
	*/

	'currency' => 'GBP',

	/*
	|--------------------------------------------------------------------------
	| Original Subscription Cost
	|--------------------------------------------------------------------------
	|
	| Amount to charge to user without discount.
	| Please specify amount as a string or float, with decimal places 
	| (e.g. '10.00' to represent $10.00).
	|
	*/

	'amount' => 49.99,

	/*
	|--------------------------------------------------------------------------
	| Payment Description
	|--------------------------------------------------------------------------
	|
	| This is the text that will appear on the PayPal payment page
	| and will serve as the description of the payment. Useful values
	| would include product name and expiration date
	|
	*/

	'description' => 'Incorporation Planner Pro',

	/*
	|--------------------------------------------------------------------------
	| PayPal Username
	|--------------------------------------------------------------------------
	|
	*/

	'username' => 'payments_api1.practicepro.co.uk',

	/*
	|--------------------------------------------------------------------------
	| PayPal Password
	|--------------------------------------------------------------------------
	|
	*/

	'password' => 'MB4YWQDQ6SQ2X7J4',

	/*
	|--------------------------------------------------------------------------
	| PayPal Account Signature
	|--------------------------------------------------------------------------
	|
	| @todo add link for generating signature
	*/

	'signature' => 'AAZrCi1Vx5cadMQKSkY4BOKmx5ZYAR0i4lktii1.u1COTU.3W4OOg0yr',

	/*
	|--------------------------------------------------------------------------
	| Payment Environment
	|--------------------------------------------------------------------------
	|
	| Either 'true' or 'false'
	|
	*/

	'testMode' => 'false'
);

