<?php

use Illuminate\Database\Migrations\Migration;

class Routes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('routes', function($table){
			$table->increments('id');
			$table->enum('route_type', array('dividend_route','salary_route','sole_trader'));
			$table->unsignedInteger('client_id');
			$table->foreign('client_id')->references('id')->on('clients')
					->onUpdate('cascade')->onDelete('cascade');
			$table->decimal('turnover');
			$table->decimal('cost_of_sales');
			$table->decimal('overheads');
			$table->decimal('directors_remuneration');
			$table->decimal('employers_nic');
			$table->decimal('drawings');
			$table->decimal('dividends_net');
			$table->decimal('corporation_tax');
			$table->decimal('income_tax');
			$table->decimal('class1_ees');
			$table->decimal('class1_ers');
			$table->decimal('class2');
			$table->decimal('class4');
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
		Schema::drop('routes');
	}

}