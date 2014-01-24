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
		$business = Business::where('businesses.id', '=', $business->id)
			->leftJoin('partners', 'business_id', '=', 'businesses.id')
			->first();
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
	public function edit($id)
	{
		$business = $this->business->find($id);

		if (is_null($business))
		{
			return Redirect::route('data_entries.index');
		}

		return View::make('data_entries.edit', compact('business'));
	}
	 */

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

		if ($validation->passes())
		{
			$business = $this->business->find($id);
			$business->update($input);

			return Redirect::route('data_entries.show', $id);
		}

		return Redirect::route('data_entries.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
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
