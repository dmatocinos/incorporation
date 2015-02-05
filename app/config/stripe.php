<?php
 
return [
    'secret_key' => 'sk_test_8XXyz7c0CVET0YHui6sLfNZC',
    'publishable_key' => 'pk_test_3pR3qv1yEIGdFsHmmN92osXF',

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

	'amount' => 4999, /* stripe uses cents, this is 49.99*/
];