<?php

use Illuminate\Database\Migrations\Migration;

class CreateGoodwill extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('businesses', function($table)
		{
			$table->integer('goodwill_estimated_value');
			$table->string('existing_business_commenced');
			$table->integer('goodwill_write_off_years');
		});

		Schema::table('users', function($table)
		{
			$table->integer('has_goodwill');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
