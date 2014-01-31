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
		$business = new Business();
		$data = compact('business');
		$data['url'] = 'save_new';
		
		$data['additional_scripts'] = array(
			'assets/js/change_listener.js',
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
		$business = $this->business;
		$data = compact('business');
		$data['url'] = 'save_update/' . $business->id;
		
		$data['additional_scripts'] = array(
			'assets/js/change_listener.js',
			'assets/js/data.js'
		);
		
		return View::make('data_entry.edit', $data);
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
		$input = array_except(Input::all(), '_method');
		
		$validation = Validator::make($input, Business::$rules);
		if ( ! $validation->passes()) {
			return Redirect::to('new')
				->withInput()
				->withErrors($validation)
				->with('message', 'There were validation errors.');
		}

		$partners = $input['partners'];
		
		if ($input['business_entity'] == 'Partnership') {
			$number_of_partners = $input['number_of_partners'];
		}
		else {
			$number_of_partners = 1;
		}

		$total = 0;
		for ($i = 0; $i < $number_of_partners; $i++) {
			$validation = Validator::make($partners[$i], Partner::$rules);
			if ( ! $validation->passes()) {
				return Redirect::to('new')
					->withInput()
					->withErrors($validation)
					->with('message', 'Partner share is required.');
			}

			$total += (int) $partners[$i]['share'];
		}

		$messages = array(
			    'foo' => 'The :attribute should be equal to 100.',
	 	);
		
		Validator::extend('foo', function($attribute, $value, $parameters) {
		    return $value == 100;
		});

		$validation = Validator::make(compact('total'), array('total'	=> 'foo'), $messages);
		if ( ! $validation->passes()) {
			return Redirect::to('new')
				->withInput()
				->withErrors($validation)
				->with('message', 'The total share for all partners should be equal to 100%');
		}

		$business = new Business;
		unset($input['_token']);
		unset($input['number_of_partners']);
		unset($input['partners']);
		$input['user_id'] = Auth::user()->id;
		
		$business->fill($input);
		$business->save();
		
		$business->setPartners($partners);

		return Redirect::to('update/' . $business->id);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function save_update($id)
	{
		$input = array_except(Input::all(), '_method');
		
		$validation = Validator::make($input, Business::$rules);
		if ( ! $validation->passes()) {
			return Redirect::to('update/' . $id)
				->withInput()
				->withErrors($validation)
				->with('message', 'There were validation errors.');
		}

		$partners = $input['partners'];
		
		if ($input['business_entity'] == 'Partnership') {
			$number_of_partners = $input['number_of_partners'];
		}
		else {
			$number_of_partners = 1;
		}

		$total = 0;
		for ($i = 0; $i < $number_of_partners; $i++) {
			$validation = Validator::make($partners[$i], Partner::$rules);
			if ( ! $validation->passes()) {
				return Redirect::route('update/' . $id)
					->withInput()
					->withErrors($validation)
					->with('message', 'Partner share is required.');
			}

			$total += (int) $partners[$i]['share'];
		}

		$messages = array(
			    'foo' => 'The :attribute should be equal to 100.',
	 	);
		Validator::extend('foo', function($attribute, $value, $parameters) {
		    return $value == 100;
		});

		$validation = Validator::make(compact('total'), array('total'	=> 'foo'), $messages);
		if ( ! $validation->passes()) {
			return Redirect::to('update/' . $id)
				->withInput()
				->withErrors($validation)
				->with('message', 'The total share for all partners should be equal to 100%');
		}

		$business = $this->business;
		unset($input['_token']);
		unset($input['number_of_partners']);
		unset($input['partners']);
		$business->update($input);
		
		$business->setPartners($partners);

		return Redirect::to('update/' . $id);
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

}
