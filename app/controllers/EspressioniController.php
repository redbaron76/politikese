<?php

class EspressioniController extends BaseController {

	public function __construct()
	{
		// $this->beforeFilter('auth.basic');
	}

	/**
	 * Display a listing of the resource.
	 * GET /espressionis
	 *
	 * @return Response
	 */
	public function index()
	{
		$espressioni = Espressione::paginate(20);

		return View::make('espressioni.index', ['espressioni' => $espressioni]);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /espressionis/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /espressionis
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /espressionis/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /espressionis/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /espressionis/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /espressionis/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}