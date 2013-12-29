<?php

use Illuminate\Database\Migrations\Migration;

class CreateClientsTaxTableInfo extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('client_tax_info', function($table) { 
			$table->increments('client_tax_info_id');
			$table->unsignedInteger('client_id');
			$table->foreign('client_id')->references('client_id')->on('clients');  //Id of the client which is probably in another separate table
			$table->decimal('client_turnover');
			$table->decimal('client_cost_of_sale');
			$table->decimal('client_overhead');
			$table->decimal('client_net_profit');
			$table->decimal('estimate_of_goodwill');
			$table->decimal('client_other_income');
			$table->boolean('shares_to_spouse');
			$table->decimal('client_spouse_other_income');
			$table->decimal('client_dividend_to_spouse');
			$table->boolean('entrep_relief_available');
			$table->integer('client_number_of_partners');
			$table->timestamp('estimated_date_of_incorporation');
			$table->boolean('commenced_after_april_2002');
			$table->integer('useful_economic_life_in_years');
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
		Schema::drop('client_tax_info');
	}

}