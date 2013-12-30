<?php

use Illuminate\Database\Migrations\Migration;

class OverallTax extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('overall_taxes', function($table){
			$table->increments('id');
			$table->unsignedInteger('client_id');
			$table->foreign('client_id')->references('id')->on('clients')
					->onUpdate('cascade')->onDelete('cascade');
			$table->decimal('tax_difference');
			$table->integer('tax_year');
			$table->decimal('vat');
			$table->date('tax_year_from');
			$table->date('tax_year_to');
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
		Schema::drop('overall_taxes');
	}

}