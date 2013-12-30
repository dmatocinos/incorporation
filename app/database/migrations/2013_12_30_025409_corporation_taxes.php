<?php

use Illuminate\Database\Migrations\Migration;

class CorporationTaxes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('corporation_taxes', function($table){
			$table->increments('id');
			$table->unsignedInteger('client_id');
			$table->foreign('client_id')->references('id')->on('clients')
					->onUpdate('cascade')->onDelete('cascade');
			$table->decimal('small_companies_rate');
			$table->decimal('full_corporation_tax_rate');
			$table->decimal('marginal_relief_lower');
			$table->decimal('marginal_relief_upper');
			$table->decimal('small_companies_fraction');
			$table->decimal('client_turnover');
			$table->decimal('tax_credit_on_dividends');
			$table->decimal('higher_rate_tax_on_dividends');
			$table->decimal('additional_rate_tax_on_dividends');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('corporation_taxes');
	}

}