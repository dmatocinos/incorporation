<?php

use Illuminate\Database\Migrations\Migration;

class CreateCapitalisation extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('capitalisation', function($table) {
			$table->increments('capitalisation_id');
			$table->string('capitalisation_name');
			$table->decimal('capitalisation_percentage');
			$table->decimal('capitalisation_minimum_charge');
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
		Schema::drop('capitalisation');
	}

}