<?php

class BusinessesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('businesses')->delete();

		$businesses = array(
			'business_entity'	=> 'Sole Trader',
			'net_profit_before_tax'	=> '100000',
			'amount_to_distribute'	=> '60000'
		);

		// Uncomment the below to run the seeder
		DB::table('businesses')->insert($businesses);
	}

}
