<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('options', function(Blueprint $table) {
			$table->increments('id');
			$table->decimal('higher_dividend_threshold_j');
			$table->decimal('higher_dividend_threshold_k');
			$table->decimal('dividend_threshold_i');
			$table->decimal('dividend_threshold_j');
			$table->decimal('dividend_threshold_k');
			$table->decimal('corporate_tax_rate_j');
			$table->decimal('corporate_tax_rate_k');
			$table->decimal('main_rate');
			$table->decimal('employees_ni_i');
			$table->decimal('employees_ni_j');
			$table->decimal('employees_ni_k');
			$table->decimal('employees_ni_l');
			$table->decimal('employers_ni_j');
			$table->decimal('employers_ni_k');
			$table->decimal('income_tax_and_ni_i');
			$table->decimal('income_tax_and_ni_j');
			$table->decimal('income_tax_and_ni_k');
			$table->decimal('income_tax_and_ni_l');
			$table->decimal('j8');
			$table->decimal('k8');
			$table->decimal('j9');
			$table->decimal('k9');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('options');
	}

}
