<?php

class DataEntryController extends AuthorizedController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$business = $this->business;
		return View::make('data_entry.edit', compact('business'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('data_entries.create');
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
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$business = $this->business->find($id);

		if (is_null($business))	{
			return Redirect::route('data_entries.index');
		}

		return View::make('data_entry.edit', compact('business'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');

		$validation = Validator::make($input, Business::$rules);
		if ( ! $validation->passes()) {
			return Redirect::route('data_entry.edit', $id)
				->withInput()
				->withErrors($validation)
				->with('message', 'There were validation errors.');
		}

		$partners = $input['partners'];
		$number_of_partners = $input['number_of_partners'];

		$total = 0;
		for ($i = 0; $i < $number_of_partners; $i++) {
			$validation = Validator::make($partners[$i], Partner::$rules);
			if ( ! $validation->passes()) {
				return Redirect::route('data_entry.edit', $id)
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
			dd($validation->errors());
			return Redirect::route('data_entry.edit', $id)
				->withInput()
				->withErrors($validation)
				->with('message', 'The total share for all partners should be equal to 100%');
		}

		$business = $this->business->find($id);
		$business->update($input);

		$business->partners()->delete();
		$business->partners()->insert($partners);

		return Redirect::route('data_entries.show', $id);
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
