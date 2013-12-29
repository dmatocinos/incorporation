<?php

use Illuminate\Database\Migrations\Migration;

class CreateCorporationTax extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('corporation_tax', function($table){
			$table->increments('corporation_tax_id');
			$table->unsignedInteger('client_id');
			$table->foreign('client_id')->references('client_id')->on('clients');
			$table->decimal('small_companies_rate');
			$table->decimal('full_corporation_tax_rate');
			$table->decimal('marginal_relief_lower');
			$table->decimal('marginal_relief_upper');
			$table->decimal('small_companies_fraction');
			$table->decimal('client_turnover');
			$table->decimal('tax_credit_on_dividends');
			$table->decimal('higher_rate_tax_on_dividends');
			$table->decimal('additional_rate_tax_on_dividends');
			$table->timestamp('created_at');
			$table->timestamp('updated_at');
			$table->timestamp('deleted_at');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('corporation_tax');
	}

}