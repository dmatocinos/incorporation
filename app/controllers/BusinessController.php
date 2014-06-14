<?php

class BusinessController extends AuthorizedController {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data['business']   = new Business();
		$data['businesses'] = Business::getAll(Auth::user()->id);
		
		$data['additional_styles'] = array(
			'packages/datatable/media/css/demo_table.css',
			'packages/datatable/media/css/custom_datatable.css'
		);
		
		$data['additional_scripts'] = array(
			'packages/datatable/media/js/jquery.dataTables.js',
			'assets/js/home.js'
		);
		
		// add the change listener
		// Asset::container('footer')->add('change-listener-js', 'js/base/change_listener.js');
		
		return View::make('businesses.home', $data);
	}

	public function addClient()
	{
		$input = Input::all();
		if ($input['select_by'] == 'existing') {
			return Redirect::to('client_details/existing/' . $input['client_id']);
		}
		else {
			return Redirect::to('client_details/new');
		}
	}

	
	private function setupData($data)
	{
		if (isset($data['s_timestamp'])) {
			$timestamp = $get['s_timestamp'];
			$input = BaseController::getParamsFromSession($timestamp);
			$business->fill($input);
			BaseController::forgetParams($timestamp);
		}
		
		$data['additional_scripts'] = array(
			'assets/js/change_listener.js',
			'assets/js/angular.min.js',
			'assets/js/data.js',
			'assets/js/index.js'
		);
		
		
		$db = DB::connection('practicepro_users');
		$data['currencies'] = $db->table('currencies')->lists('name', 'id');
		$data['counties']   = ['' => ''] + $db->table('counties')->lists('county', 'county');
		$data['countries']  = ['' => ''] + $db->table('countries')->lists('country_name', 'country_name');

		return View::make('data_entry.index', $data);

	}

	public function update($business_id)
	{
		$client = Client::find($this->business->client_id);

		$data = [
			'client_data' => $client->getAttributes(),
			'business'    => $this->business
		];
		return $this->setupData($data);
	}

	public function newClient()
	{
		$client = new Client;
		$data = [
			'client_data' => array_fill_keys($client->getFillable(), null),
			'business'    => new Business
		];
		return $this->setupData($data);
	}

	public function existingClient($client_id)
	{
		$client = Client::on('practicepro_users')->find($client_id);
		$data = [
			'client_data' => $client->getAttributes(),
			'business'    => new Business
		];
		return $this->setupData($data);
	}


	public function createClient() 
	{
		$input = Input::all();
		$validator = Validator::make($input, Client::$rules);
		if ($validator->passes()) {
			$input['business_type'] = $input['business_entity'];
			$input['period_start_date'] = date('Y-m-d H:i:a', strtotime($input['period_start_date']));
			$input['period_end_date'] = date('Y-m-d H:i:a', strtotime($input['period_end_date']));

			$client = Client::create($input);	

			$data = [
				'business_entity' 	 => $input['business_entity'],
				'net_profit_before_tax'  => $input['net_profit_before_tax'],
				'number_of_partners' 	 => $input['number_of_partners'],
				'fee_based_on_tax_saved' => $input['fee_based_on_tax_saved'],
				'client_id'		 => $client->id,
			];

			return $this->save($data, $client->id);

		}
		else {
			return Redirect::to('client_details/new');
				->withInput()
				->withErrors($validator)
				->with('message', 'There were validation errors.');
		}
	}

	public function updateClient() 
	{
		$input = Input::all();

		$validator = Validator::make($input, Client::$rules);
		if ($validator->passes()) {
			$input['business_type'] = $input['business_entity'];
			$input['period_start_date'] = date('Y-m-d H:i:a', strtotime($input['period_start_date']));
			$input['period_end_date'] = date('Y-m-d H:i:a', strtotime($input['period_end_date']));

			$client = Client::find($input['id']);
			$client->update($input);

			$data = [
				'business_entity' 	 => $input['business_entity'],
				'net_profit_before_tax'  => $input['net_profit_before_tax'],
				'number_of_partners' 	 => $input['number_of_partners'],
				'fee_based_on_tax_saved' => $input['fee_based_on_tax_saved'],
				'client_id'		 => $client->id,
			];

			return $this->save($data, $client->id);

		}
		else {
			return Redirect::to('client_details/new');
				->withInput()
				->withErrors($validator)
				->with('message', 'There were validation errors.');
		}
		
	}

	private function save($data, $client_id)
	{
		$data['number_of_partners'] = $data['business_entity'] == 'Partnership' ? $data['number_of_partners'] : 1;
		$data['user_id'] = Auth::user()->id;

		$route = (isset($input['save_and_next_button'])) ? 'summary' : 'update/update';

		if (! $this->business) {
			$pricing = Auth::user()->practice_pro_user->pricing;
			if (Auth::user()->practice_pro_user->getMembershipLevelDisplayAttribute() != 'Free Trial' && ! $pricing->is_free) {
				return Redirect::route('subscribe')->withInput();
			}

			$business = Business::create($data);	
			$id = $business->id;
		}
		else {
			if (!$this->isBusinessOwned($this->business)) {
				return Redirect::to('update/' . $this->business->id)
					->with('message', 'You cannot make changes to this business');
			}

			$this->business->update($data);
			$id = $this->business->id;
		}

		$route = (isset($input['save_and_next_button'])) ? 'summary' : 'update';

		return Redirect::to($route . '/' . $id)
			->with('message', 'Successfully saved.');
		
	}

	public function delete()
	{
		if (!$this->isBusinessOwned($this->business)) {
			return Redirect::to('')
				->with('message', 'You cannot delete this business');
		}
		
		$this->business->deletePartners();
		$this->business->delete();
		
		return Redirect::to('')
				->with('message', 'You have successfully deleted a business');
	}

	protected function isBusinessOwned ($business) 
	{
		return ($business->user_id == Auth::user()->id) ? true : false;
	}

}
