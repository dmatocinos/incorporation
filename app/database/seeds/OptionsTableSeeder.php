<?php

class OptionsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('options')->delete();

		$options = array(
			'higher_dividend_threshold_j' => '150000',
			'higher_dividend_threshold_k' => '42.5',
			'dividend_threshold_i' => '10',
			'dividend_threshold_j' => '32010',
			'dividend_threshold_k' => '32.5',
			'corporate_tax_rate_j' => '20',
			'corporate_tax_rate_k' => '300000',
			'main_rate' => '23',
			'employees_ni_i' => '2',
			'employees_ni_j' => '12',
			'employees_ni_k' => '7748',
			'employees_ni_l' => '33696',
			'employers_ni_j' => '13.8',
			'employers_ni_k' => '7696',
			'income_tax_and_ni_i' => '9',
			'income_tax_and_ni_j' => '20',
			'income_tax_and_ni_k' => '9440',
			'income_tax_and_ni_l' => '1774',
			'j8' => '40',
			'k8' => '32011',
			'j9' => '45',
			'k9' => '150001'
		);

		// Uncomment the below to run the seeder
		DB::table('options')->insert($options);
	}

}
