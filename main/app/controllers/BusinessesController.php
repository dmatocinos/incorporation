<?php

class BusinessesController extends BaseController {

	/**
	 * Business Repository
	 *
	 * @var Business
	 */
	protected $business;

	public function __construct(Business $business)
	{
		$this->business = $business;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$businesses = $this->business->all();

		return View::make('businesses.index', compact('businesses'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('businesses.create');
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

			return Redirect::route('businesses.index');
		}

		return Redirect::route('businesses.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$business = $this->business->findOrFail($id);

		return View::make('businesses.show', compact('business'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$business = $this->business->find($id);

		if (is_null($business))
		{
			return Redirect::route('businesses.index');
		}

		return View::make('businesses.edit', compact('business'));
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

		if ($validation->passes())
		{
			$business = $this->business->find($id);
			$business->update($input);

			return Redirect::route('businesses.show', $id);
		}

		return Redirect::route('businesses.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->business->find($id)->delete();

		return Redirect::route('businesses.index');
	}

}
