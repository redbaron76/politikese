<?php

class EspressioniController extends BaseController {

	/**
	 * [$espressione description]
	 * @var [type]
	 */
	protected $espressione;

	/**
	 * [$messages description]
	 * @var [type]
	 */
	public static $messages = [
		'required' => 'Il campo :attribute è obbligatorio',
		'unique' => 'Questa espressione è già presente',
	];

	/**
	 * [__construct description]
	 * @param Espressione $espressione [description]
	 */
	public function __construct(Espressione $espressione)
	{
		$this->beforeFilter('auth.basic');
		$this->espressione = $espressione;
	}

	/**
	 * Display a listing of the resource.
	 * GET /espressionis
	 *
	 * @return Response
	 */
	public function index()
	{
		$espressioni = $this->espressione->orderBy('text', 'asc')->paginate(20);

		return View::make('espressioni.index', compact('espressioni'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /espressionis/create
	 *
	 * @return Response
	 */
	public function create()
	{
		// return View::make('espressioni.create');
		return View::make('espressioni.edit');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /espressionis
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, Espressione::rules(), self::$messages);

		if ($validation->passes())
		{
			if(isset($input['articoli']))
			{
				Event::fire('articoli.save', [$espressione, $input['articoli']]);
				$input = array_except($input, 'articoli');
			}

			if(isset($input['preposizioni']))
			{
				Event::fire('preposizioni.save', [$espressione, $input['preposizioni']]);
				$input = array_except($input, 'preposizioni');
			}

			if(isset($input['tags']))
			{
				Event::fire('tags.save', [$espressione, $input['tags']]);
				$input = array_except($input, 'tags');
			}

			$espressione = $this->espressione->create($input);

			return Redirect::route('espressioni.index');
		}

		return Redirect::route('espressioni.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'Si è verificato un errore');
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
		$espressione = $this->espressione
							->with(['articoli', 'congiunzioni', 'preposizioni', 'tags'])
							->whereId($id)
							->first();

		if (is_null($espressione))
		{
			return Redirect::route('espressioni.index');
		}

		return View::make('espressioni.edit', compact('espressione'));
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
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, Espressione::rules($id), self::$messages);

		if ($validation->passes())
		{
			$espressione = $this->espressione->find($id);

			if(isset($input['articoli']))
			{
				Event::fire('articoli.save', [$espressione, $input['articoli']]);
				$input = array_except($input, 'articoli');
			}

			if(isset($input['preposizioni']))
			{
				Event::fire('preposizioni.save', [$espressione, $input['preposizioni']]);
				$input = array_except($input, 'preposizioni');
			}
			
			if(isset($input['tags']))
			{
				Event::fire('tags.save', [$espressione, $input['tags']]);
				$input = array_except($input, 'tags');
			}

			$espressione->update($input);

			return Redirect::route('espressioni.index');
		}

		return Redirect::route('espressioni.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'Si è verificato un errore');
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
		$this->espressione->find($id)->delete();

		return Redirect::route('espressioni.index');
	}

}