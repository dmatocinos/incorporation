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
		Schema::table('business', function($table)
		{
			$this->integer('has_goodwill');
			$this->integer('goodwill_estimated_value');
			$this->string('existing_business_commenced');
			$this->integer('goodwill_write_off_years');
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
