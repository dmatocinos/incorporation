<?php

use Illuminate\Database\Migrations\Migration;

class Capitalisations extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('capitalisations', function($table) {
			$table->increments('id');
			$table->string('capitalisation_name');
			$table->decimal('capitalisation_percentage');
			$table->decimal('capitalisation_minimum_charge');
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
		Schema::drop('capitalisations');
	}

}