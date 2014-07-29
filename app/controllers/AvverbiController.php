<?php

class AvverbiController extends BaseController {

	/**
	 * [$avverbio description]
	 * @var [type]
	 */
	protected $avverbio;

	/**
	 * [$messages description]
	 * @var [type]
	 */
	public static $messages = [
		'required' => 'Il campo :attribute è obbligatorio',
		'unique' => 'Questo avverbio è già presente',
	];

	/**
	 * [__construct description]
	 * @param Espressione $avverbio [description]
	 */
	public function __construct(Avverbio $avverbio)
	{
		$this->beforeFilter('auth.basic');
		$this->avverbio = $avverbio;
	}

	/**
	 * Display a listing of the resource.
	 * GET /avverbis
	 *
	 * @return Response
	 */
	public function index()
	{
		$avverbi = $this->avverbio->orderBy('text', 'asc')->paginate(20);

		return View::make('avverbi.index', compact('avverbi'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /avverbis/create
	 *
	 * @return Response
	 */
	public function create()
	{
		// return View::make('avverbi.create');
		return View::make('avverbi.edit');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /avverbis
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, Avverbio::rules(), self::$messages);

		if ($validation->passes())
		{
			$avverbio_new = [
				'text' => $input['text'],
			];

			$avverbio = $this->avverbio->create($avverbio_new);

			if(isset($input['tags']))
			{
				Event::fire('tags.save', [$avverbio, $input['tags']]);
			}

			return Redirect::route('avverbi.index');
		}

		return Redirect::route('avverbi.edit')
			->withInput()
			->withErrors($validation)
			->with('message', 'Si è verificato un errore');
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /avverbis/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$avverbio = $this->avverbio
							->with(['tags'])
							->whereId($id)
							->first();

		if (is_null($avverbio))
		{
			return Redirect::route('avverbi.index');
		}

		return View::make('avverbi.edit', compact('avverbio'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /avverbis/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, Avverbio::rules($id), self::$messages);

		if ($validation->passes())
		{
			$avverbio = $this->avverbio->find($id);
			
			if(isset($input['tags']))
			{
				Event::fire('tags.save', [$avverbio, $input['tags']]);
				$input = array_except($input, 'tags');
			}

			$avverbio->update($input);

			return Redirect::route('avverbi.index');
		}

		return Redirect::route('avverbi.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'Si è verificato un errore');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /avverbis/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->avverbio->find($id)->delete();

		return Redirect::route('avverbi.index');
	}

}