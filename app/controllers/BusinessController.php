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
    
    public function business($business_id)
    {
        $client = new Client;
        
        if (is_numeric($business_id)) {
            $business = Business::find($business_id);
            
            if (!$this->isBusinessOwned($business)) {
                return Redirect::to('')
                    ->with('message', 'You cannot edit this business');
            }
            
            if ($business->client_id) {
                $client = Client::find($business->client_id);
            }
        }
        else {
            $business = new Business;
            
            // new business, check if from existing client
            
            if ($client_id = Input::get('client_id')) {
                $client = Client::find($client_id);
            }
        }
        
        if ($timestamp = Input::get('s_timestamp')) {
        	$input = BaseController::getParamsFromSession($timestamp);
            
            BaseController::forgetParams($timestamp);
		}
        else {
            $input = Input::old();
        }
        
        if (! empty($input)) {
            if (isset($input['client_id'])) {
                $client = Client::find($input['client_id']);
            }
            
            $business->fill($input);
            $client->fill($input);
        }
        
        $data = [
			'client'   => $client,
			'business' => $business
		];
        
        return $this->setupData($data);
    }

	private function setupData($data)
	{
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

	public function create()
	{
        $input = Input::all();
        
        if ($input['select_by'] == 'new_client'){
            return Redirect::to('business/new');
        }
        else {
            return Redirect::to('business/new?client_id=' . $input['client_id']);
        }
	}

	public function existingClient($client_id)
	{
        return Redirect::to('business/new?client_id='. $client_id);
	}

	public function save()
	{
        $data = Input::all();
        
        $validator = Validator::make($data, Client::$rules);
        
		if (! $validator->passes()) {
            $business_id = (isset($data['business_id']) && is_numeric($data['business_id'])) ? $data['business_id'] : 'new';
            //$params      = ($business_id == 'new' && isset($data['client_id']) && is_numeric($data['client_id'])) ? ('?client_id=' . $data['client_id']
            
            return Redirect::back()
				->withInput()
				->withErrors($validator)
				->with('message', 'Please correct the field(s) below marked in red');
        }
        
		$data['number_of_partners'] = $data['business_entity'] == 'Partnership' ? $data['number_of_partners'] : 1;
		$data['user_id'] = Auth::user()->id;

		if (! (isset($data['business_id']) && is_numeric($data['business_id']))) {
			$pricing = Auth::user()->practice_pro_user->pricing;
            
			if (Auth::user()->practice_pro_user->getMembershipLevelDisplayAttribute() != 'Free Trial' && ! $pricing->is_free) {
				return Redirect::route('subscribe')->withInput();
			}
        }
		else {
            $business = Business::find($data['business_id']);
            
			if (!$this->isBusinessOwned($business)) {
				return Redirect::to('')
					->with('message', 'You cannot make changes to this business');
			}
        }
        
        $business = Business::saveBusiness($data);
		$id = $business->id;

		$route = (isset($data['save_next_page'])) ? 'summary' : 'business';
        
		return Redirect::to($route . '/' . $id)
			->with('message', 'Successfully saved changes.');
		
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
