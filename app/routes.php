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
	return View::make('hello');
});

/*
|--------------------------------------------------------------------------
| Incorporation Routes
|--------------------------------------------------------------------------
|
*/
Route::get('options', array('uses' => 'OptionsController@edit', 'as' => 'options.edit'));
Route::put('options', array('uses' => 'OptionsController@update', 'as' => 'options.update'));

Route::resource('data_entry', 'DataEntryController');

Route::group(array('prefix' => 'results'), function() {
	Route::get('partnership_tax',	array('uses' => 'PartnershipTaxAndNationalInsuranceController@show',	'as' => 'results.partnership_tax.show'));
	Route::get('salary',		array('uses' => 'SalaryInLimitedCoController@show',			'as' => 'results.salary.show'));
	Route::get('dividends',		array('uses' => 'DividendsInLimitedCoController@show',			'as' => 'results.dividends.show'));
});

Route::get('summary', array('uses' => 'SummaryController@show', 'as' => 'summary.show'));
Route::get('report', array('uses' => 'ReportController@download', 'as' => 'report.download'));
