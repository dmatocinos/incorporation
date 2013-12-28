<?php

class PartnersTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('partners')->delete();

		$business = Business::where('business_entity', '=', 'Sole Trader')->first();
		$partners = array(
			'business_id'	=> $business->id,
			'share'		=> '100'
		);

		// Uncomment the below to run the seeder
		DB::table('partners')->insert($partners);
	}

}
