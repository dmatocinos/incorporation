<?php
/*
|--------------------------------------------------------------------------
| Scaffolding/Testing
|--------------------------------------------------------------------------
|
| @todo: comment out on production
|
*/
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
	Route::any("logout", [
		"as"   => "logout",
		"uses" => "AuthController@logout"
	]);
	
	Route::get("/", "BusinessController@index");
	Route::get('create', 'BusinessController@create_ui');
	Route::get('update/{business_id}', 'BusinessController@update_ui');
	Route::get('delete/{business_id}', 'BusinessController@delete');
	Route::put('save_new', 'BusinessController@save_new');
	Route::put('save_update/{business_id}', 'BusinessController@save_update');
	Route::get('results/{business_id}',	'ResultsController@show');
	Route::get('summary/{business_id}', 'SummaryController@show');
	Route::get('report', array('uses' => 'ReportController@download', 'as' => 'report.download'));
	Route::get('report/incorporation/{business_id}', array('uses' => 'ReportController@incorporation', 'as' => 'report.incorporation'));
	Route::get('goodwill/{business_id}', 'GoodwillController@show');
	Route::get('goodwill/report/{business_id}', array('uses' => 'GoodwillController@download', 'as' => 'goodwill.report'));
	Route::any('goodwill/paypal/{business_id}', 'GoodwillController@goodwillPayment');
	Route::any('goodwill/paypal_return/{business_id}', 'GoodwillController@returnPayment');
	Route::any('goodwill/paypal_cancel/{business_id}', 'GoodwillController@cancelPayment');
});

