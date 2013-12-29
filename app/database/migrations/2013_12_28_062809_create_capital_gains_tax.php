<?php

use Illuminate\Database\Migrations\Migration;

class CreateCapitalGainsTax extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('capital_gains_tax', function($table){
			$table->increments('capital_gains_tax_id');
			$table->unsignedInteger('client_id');
			$table->foreign('client_id')->references('client_id')->on('clients');
			$table->decimal('cgt_annual_exemption');
			$table->decimal('capital_gains_tax_rate');
			$table->decimal('higher_cgt_rate');
			$table->decimal('entrepreneur_rate');
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
		Schema::drop('capital_gains_tax');
	}

}