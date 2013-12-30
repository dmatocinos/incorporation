<?php

use Illuminate\Database\Migrations\Migration;

class NationalInsurance extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('national_insurances', function($table){
			$table->increments('id');
			$table->unsignedInteger('client_id');
			$table->foreign('client_id')->references('id')->on('clients')
					->onUpdate('cascade')->onDelete('cascade');
			$table->decimal('class1_ees_primary_threshold');
			$table->decimal('class1_ees_upper_earnings');
			$table->decimal('class1_ees_higher_rate');
			$table->decimal('class1_ees_rate');
			$table->decimal('class1_ers_lower_earnings');
			$table->decimal('class1_ers_rate');
			$table->decimal('class2_weekly_amount');
			$table->decimal('class2_small_earning_excep');
			$table->decimal('class4_lower_profits_limit');
			$table->decimal('class4_upper_profit_limits');
			$table->decimal('class4_higher_rate');
			$table->decimal('class4_rate');
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
		Schema::drop('national_insurances');
	}

}