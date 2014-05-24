<?php
/*
|--------------------------------------------------------------------------
| Scaffolding/Testing
|--------------------------------------------------------------------------
|
| @todo: comment out on production
|
*/
Route::get('install/{key?}',  array('as' => 'install', function($key = null)
{
       if($key == "where_are_the_cranberries"){
               try {
					
                       echo '<br>init migrate:install...';
                       Artisan::call('migrate:install');
                       echo 'done migrate:install';
                       
                       echo '<br>init with app tables migrations...';
                       Artisan::call('migrate', [
                               '--path'     => "app/database/migrations"
                               ]);
                       echo '<br>done with app tables migrations';
					
                       echo '<br>init with tables seeders...';
                       Artisan::call('db:seed');
                       echo '<br>done with tables seeders...';

               } catch (Exception $e) {
					echo $e->getMessage();
                    Response::make($e->getMessage(), 500);
               }
       }else{
               App::abort(404);
       }
}));

Route::get('install/migrate/{key?}',  array('as' => 'install.migrate', function($key = null)
{
	if ($key == "where_are_the_cranberries"){
                       Artisan::call('migrate', [
                               '--path'     => "app/database/migrations"
                               ]);
                       echo '<br>done with app tables migrations';
	}
}));
			

Route::get('pull/{key?}',  array('as' => 'install', function($key = null)
{
       if($key == "where_are_the_cranberries"){
               try {
                       echo '<br>git pull origin master...';
		       SSH::run(array(
			       'cd /kunden/homepages/46/d354086249/htdocs/incorporationpro-app',
			       'git pull origin master',
		       ));
                       echo '<br>done pulling changes.';

               } catch (Exception $e) {
		    echo $e->getMessage();
                    Response::make($e->getMessage(), 500);
               }
       }else{
               App::abort(404);
       }
}));

Route::resource('businesses', 'BusinessesController');
Route::resource('partners', 'PartnersController');
Route::resource('options', 'OptionsController');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::get('/', function()
{
	return View::make('layouts.authorized');
});

/*
|--------------------------------------------------------------------------
| Incorporation Routes
|--------------------------------------------------------------------------
|
*/
Route::group(["before" => "guest"], function()
{
	Route::get("/", "AuthController@login");

	Route::any("login", [
		"as"   => "login",
		"uses" => "AuthController@login"
	]);
});

Route::group(["before" => "auth"], function()
{
	Route::get('subscribe', array('as' => 'subscribe', 'uses' => 'SubscriptionController@subscribe'));
	Route::get('start_payment/{timestamp}', array('as' => 'start_payment', 'uses' => 'SubscriptionController@startPayment'));
	Route::get('cancel_payment/{timestamp}', array('as' => 'cancel_payment', 'uses' => 'SubscriptionController@cancelPayment'));
	Route::get('complete_payment/{timestamp}', array('as' => 'complete_payment', 'uses' => 'SubscriptionController@completePayment'));
	Route::get('complete_subscription', array('as' => 'complete_subscription', 'uses' => 'SubscriptionController@completeSubscription'));

	Route::get('upgrade', array('as' => 'upgrade_start', 'uses' => 'UpgradeMembershipController@upgrade'));
	Route::get('upgrade/start_payment/{level}', array('as' => 'upgrade-start_payment', 'uses' => 'UpgradeMembershipController@startPayment'));
	Route::get('upgrade/cancel_payment', array('as' => 'upgrade_cancel_payment', 'uses' => 'UpgradeMembershipController@cancelPayment'));
	Route::get('upgrade/complete_payment/{level}', array('as' => 'upgrade_complete_payment', 'uses' => 'UpgradeMembershipController@completePayment'));
	Route::get('upgrade/complete_subscription', array('as' => 'upgrade_complete_subscription', 'uses' => 'UpgradeMembershipController@completeUpgradeMembership'));

	Route::any("logout", [
		"as"   => "logout",
		"uses" => "AuthController@logout"
	]);
	
	Route::get("/", array('as' => 'home', 'uses' => "BusinessController@index"));
	Route::get('create', array('as' => 'create', 'uses' => 'BusinessController@create_ui'));
	Route::get('update/{business_id}', 'BusinessController@update_ui');
	Route::get('delete/{business_id}', 'BusinessController@delete');
	Route::put('save_new', 'BusinessController@save_new');
	Route::put('save_update/{business_id}', 'BusinessController@save_update');
	Route::get('results/{business_id}',	'ResultsController@show');
	Route::get('summary/{business_id}', 'SummaryController@show');
	Route::get('report', array('uses' => 'ReportController@download', 'as' => 'report.download'));
	Route::get('report/incorporation/{business_id}', array('uses' => 'ReportController@incorporation', 'as' => 'report.incorporation'));
	Route::get('goodwill/{business_id}', 'GoodwillController@show');
	Route::any('goodwill/paypal/{business_id}', 'GoodwillController@goodwillPayment');
	Route::any('goodwill/paypal_return/{business_id}', 'GoodwillController@returnPayment');
	Route::any('goodwill/paypal_cancel/{business_id}', 'GoodwillController@cancelPayment');

	Route::group(["before" => "can_download"], function()
	{
		Route::get('report/incorporation/{business_id}', array('uses' => 'ReportController@incorporation', 'as' => 'report.incorporation'));
	});

	Route::post('email_support', array('as' => 'email_support', 'uses' => 'BaseController@sendEmailSupport'));
	Route::get("restrictdownloads/{valuation_id}", array('as' => 'restrictdownloads', 'uses' => 'SummaryController@restrictDownloads'));
});

