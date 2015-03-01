<?php

use Illuminate\Database\Migrations\Migration;

class Clients extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clients', function($table){
			$table->increments('id');
			$table->string('client_first_name');
			$table->string('client_last_name');
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
		Schema::drop('clients');
	}

}