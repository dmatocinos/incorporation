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
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create_ui()
	{
		$get      = Input::get();
		$business = new Business();
		
		if (isset($get['s_timestamp'])) {
			$timestamp = $get['s_timestamp'];
			$input = BaseController::getParamsFromSession($timestamp);
			$business->fill($input);
			BaseController::forgetParams($timestamp);
		}
		
		$data        = compact('business');
		$data['url'] = 'save_new';
		
		$data['additional_scripts'] = array(
			'assets/js/change_listener.js',
			'assets/js/angular.min.js',
			'assets/js/data.js'
		);
		
		return View::make('data_entry.edit', $data);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function update_ui()
	{
		if (!$this->isBusinessOwned($this->business)) {
			return Redirect::to('')
				->with('message', 'You cannot make changes to this business');
		}
		
		$business = $this->business;
		$data = compact('business');
		$data['url'] = 'save_update/' . $business->id;
		
		$data['additional_scripts'] = array(
			'assets/js/change_listener.js',
			'assets/js/angular.min.js',
			'assets/js/data.js'
		);
		
		return View::make('data_entry.edit', $data);
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
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

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Business::$rules);

		if ($validation->passes())
		{
			$this->business->create($input);

			return Redirect::route('data_entries.index');
		}

		return Redirect::route('data_entries.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	public function show($id)
	{
		App::abort(404);
	}
	 */
	 
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function save_new()
	{
		$input = array_except(Input::all(), array('_token', '_method'));
		return self::saveBusiness(new Business, array_except(Input::all(), '_method'), 'create');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function save_update($id)
	{
		if (!$this->isBusinessOwned($this->business)) {
			return Redirect::to('')
				->with('message', 'You cannot make changes to this business');
		}
		
		return self::saveBusiness($this->business, array_except(Input::all(), '_method'), 'update');
	}
    
    public static function saveBusiness($business, $input, $page_origin) {
        $validation = Validator::make($input, Business::$rules);
        
		if ( ! $validation->passes()) {
			return Redirect::to($page_origin . ($page_origin == 'update' ? ('/' . $business->id) : ''))
				->withInput()
				->withErrors($validation)
				->with('message', 'There were validation errors.');
		}

		if ($input['business_entity'] == 'Partnership') {
			$number_of_partners = $input['number_of_partners'];
		}
		else {
			$number_of_partners = 1;
		}

		if ($page_origin == 'create') {
			$pricing = Auth::user()->practice_pro_user->pricing;
			if (Auth::user()->practice_pro_user->getMembershipLevelDisplayAttribute() != 'Free Trial' && ! $pricing->is_free) {
				return Redirect::route('subscribe')->withInput();
			}
        }
        
		$next_page = (isset($input['save_and_next_button'])) ? 'summary' : 'update';

		unset($input['_token']);
		unset($input['_mthod']);
		unset($input['partners']);
        unset($input['save_button']);
        unset($input['save_and_next_button']);
		$input['user_id'] = Auth::user()->id;
		
        if ($page_origin == 'create') {
            $business->fill($input);
            $business->save();
        }
        else {
            $business->update($input);
        }
		
		return Redirect::to($next_page . '/' . $business->id);
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	public function destroy($id)
	{
	}
	 */
	 
	protected function isBusinessOwned ($business) {
		return ($business->user_id == Auth::user()->id) ? true : false;
	}

}
