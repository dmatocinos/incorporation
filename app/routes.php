<?php

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
| Register all the pages for the incorporation app.
|
*/
Route::get('assumptions', array('uses' => 'AssumptionsController@index', 'as' => 'assumptions.index'));

Route::get('options', array('uses' => 'OptionsController@edit', 'as' => 'options.edit'));
Route::put('options', array('uses' => 'OptionsController@update', 'as' => 'options.update'));

Route::get('data_entry', array('uses' => 'DataEntryController@edit', 'as' => 'data_entry.edit'));
Route::put('data_entry', array('uses' => 'DataEntryController@update', 'as' => 'data_entry.update'));

Route::group(array('prefix' => 'results'), function() {
	Route::get('sole_trader', array('uses' => 'SoleTraderController@show', 'as' => 'results.sole_trader.show'));
	Route::get('salary', array('uses' => 'SalaryController@show', 'as' => 'results.salary.show'));
	Route::get('dividend', array('uses' => 'DividendController@show', 'as' => 'results.dividend.show'));
});

Route::get('summary', array('uses' => 'SummaryController@show', 'as' => 'summary.show'));
Route::get('report', array('uses' => 'ReportController@download', 'as' => 'report.download'));

Route::resource('clients', 'ClientController');
