<?php

use Illuminate\Database\Migrations\Migration;

class CreateOverallTax extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('overall_tax', function($table){
			$table->increments('overall_tax_id');
			$table->unsignedInteger('client_id');
			$table->foreign('client_id')->references('client_id')->on('clients');
			$table->decimal('tax_difference');
			$table->integer('tax_year');
			$table->decimal('vat');
			$table->date('tax_year_from');
			$table->date('tax_year_to');
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
		Schema::drop('overall_tax');
	}

}