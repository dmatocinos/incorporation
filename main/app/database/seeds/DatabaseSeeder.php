<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		//$this->call('BusinessesTableSeeder');
		//$this->call('PartnersTableSeeder');
		$this->call('OptionsTableSeeder');
		//$this->call('PricingTableSeeder');
	}

}
