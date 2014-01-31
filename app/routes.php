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
Route::resource('data_entry', 'DataEntryController');
Route::get('results',	array('uses' => 'ResultsController@show',	'as' => 'results.show'));
Route::get('summary',	array('uses' => 'SummaryController@show',	'as' => 'summary.show'));
/*
Route::group(array('prefix' => 'results'), function() {
	Route::get('partnership_tax',	array('uses' => 'ResultsController@partnershipTaxAndNationalInsurance',	'as' => 'results.partnership_tax'));
	Route::get('salary',		array('uses' => 'ResultsController@salaryInLimitedCo',			'as' => 'results.salary'));
	Route::get('dividends',		array('uses' => 'ResultsController@dividendsInLimitedCo',		'as' => 'results.dividends'));
});
Route::group(array('prefix' => 'summary'), function() {
	Route::get('total_savings', 	array('uses' => 'SummaryController@totalSavings',			'as' => 'summary.total_savings'));
	Route::get('graphs', 		array('uses' => 'SummaryController@graphs',				'as' => 'summary.graphs'));
});
*/

Route::get('report/incorporation', array('uses' => 'ReportController@incorporation', 'as' => 'report.incorporation'));
