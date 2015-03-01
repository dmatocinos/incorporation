<?php

class PartnersController extends BaseController {

	/**
	 * Partner Repository
	 *
	 * @var Partner
	 */
	protected $partner;

	public function __construct(Partner $partner)
	{
		$this->partner = $partner;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$partners = $this->partner->all();

		return View::make('partners.index', compact('partners'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('partners.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Partner::$rules);

		if ($validation->passes())
		{
			$this->partner->create($input);

			return Redirect::route('partners.index');
		}

		return Redirect::route('partners.create')
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
		$partner = $this->partner->findOrFail($id);

		return View::make('partners.show', compact('partner'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$partner = $this->partner->find($id);

		if (is_null($partner))
		{
			return Redirect::route('partners.index');
		}

		return View::make('partners.edit', compact('partner'));
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
		$validation = Validator::make($input, Partner::$rules);

		if ($validation->passes())
		{
			$partner = $this->partner->find($id);
			$partner->update($input);

			return Redirect::route('partners.show', $id);
		}

		return Redirect::route('partners.edit', $id)
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
		$this->partner->find($id)->delete();

		return Redirect::route('partners.index');
	}

}
