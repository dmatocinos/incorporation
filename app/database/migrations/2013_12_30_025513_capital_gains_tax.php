<?php

use Illuminate\Database\Migrations\Migration;

class CapitalGainsTax extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('capital_gains_taxes', function($table){
			$table->increments('id');
			$table->unsignedInteger('client_id');
			$table->foreign('client_id')->references('id')->on('clients')
					->onUpdate('cascade')->onDelete('cascade');
			$table->decimal('cgt_annual_exemption');
			$table->decimal('capital_gains_tax_rate');
			$table->decimal('higher_cgt_rate');
			$table->decimal('entrepreneur_rate');
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
		Schema::drop('capital_gains_taxes');
	}

}