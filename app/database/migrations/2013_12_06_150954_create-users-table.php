<?php

use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("users", function($table)
		{
		    $table->increments("id");
		    $table
			->string("username")
			->nullable()
			->default(null);
		    $table
			->string("password")
			->nullable()
			->default(null);
		    $table
			->string("email")
			->nullable()
			->default(null);
		    $table
			->dateTime("created_at")
			->nullable();
		    $table
			->dateTime("updated_at")
			->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists("users");
	}

}
