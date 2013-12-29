<?php

use Illuminate\Database\Migrations\Migration;

class CreateRouteTypes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('routes', function($table){
			$table->increments('route_id');
			$table->enum('route_type', array('dividend_route','salary_route','sole_trader'));
			$table->unsignedInteger('client_id');
			$table->foreign('client_id')->references('client_id')->on('clients');
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
		Schema::drop('routes');
	}

}