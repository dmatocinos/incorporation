<?php

use Illuminate\Database\Migrations\Migration;

class IncomeTaxData extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('income_tax_data', function($table){
			$table->increments('id');
			$table->unsignedInteger('client_id');
			$table->foreign('client_id')->references('id')->on('clients')
					->onUpdate('cascade')->onDelete('cascade');
			$table->decimal('personal_allowance');
			$table->decimal('higher_rate_tax_band');
			$table->decimal('additional_rate_tax_band');
			$table->decimal('allowance_adjustment_limit');
			$table->decimal('basic_rate_of_tax');
			$table->decimal('higher_rate_of_tax');
			$table->decimal('additional_rate_of_tax');
			$table->decimal('commulative_tax_to_higher_rate');
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
		Schema::drop('income_tax_data');
	}

}