<?php

class VerbiController extends BaseController {

	/**
	 * [$verbo description]
	 * @var [type]
	 */
	protected $verbo;

	/**
	 * [$messages description]
	 * @var [type]
	 */
	public static $messages = [
		'required' => 'Il campo :attribute è obbligatorio',
		'unique' => 'Questo verbo è già presente',
	];

	/**
	 * [__construct description]
	 * @param Espressione $verbo [description]
	 */
	public function __construct(Verbo $verbo)
	{
		$this->beforeFilter('auth.basic');
		$this->verbo = $verbo;
	}

	/**
	 * Display a listing of the resource.
	 * GET /verbi
	 *
	 * @return Response
	 */
	public function index()
	{
		$verbi = $this->verbo->orderBy('infinito', 'asc')->paginate(20);

		return View::make('verbi.index', compact('verbi'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /verbi/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('verbi.edit');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /verbi
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, Verbo::rules(), self::$messages);

		if ($validation->passes())
		{
			$verbo_new = [
				'infinito' => $input['infinito'],
				'gerundio' => $input['gerundio'],
				'presente1s' => $input['presente1s'],
				'presente3s' => $input['presente3s'],
				'presente1p' => $input['presente1p'],
				'presente3p' => $input['presente3p'],
				'passato1s' => $input['passato1s'],
				'passato3s' => $input['passato3s'],
				'passato1p' => $input['passato1p'],
				'passato3p' => $input['passato3p'],
				'congiuntivo1s' => $input['congiuntivo1s'],
				'congiuntivo3s' => $input['congiuntivo3s'],
				'congiuntivo1p' => $input['congiuntivo1p'],
				'congiuntivo3p' => $input['congiuntivo3p'],
				'riflessivo1s' => $input['riflessivo1s'],
				'riflessivo3s' => $input['riflessivo3s'],
				'riflessivo1p' => $input['riflessivo1p'],
				'riflessivo3p' => $input['riflessivo3p'],
				'partpresente' => $input['partpresente'],
				'partpassato' => $input['partpassato']
			];

			$verbo = $this->verbo->create($verbo_new);

			if(isset($input['articoli']))
			{
				Event::fire('articoli.save', [$verbo, $input['articoli']]);
			}

			if(isset($input['preposizioni']))
			{
				Event::fire('preposizioni.save', [$verbo, $input['preposizioni']]);
			}

			if(isset($input['tags']))
			{
				Event::fire('tags.save', [$verbo, $input['tags']]);
			}

			return Redirect::route('espressioni.index');
		}

		return Redirect::route('verbi.edit')
			->withInput()
			->withErrors($validation)
			->with('message', 'Si è verificato un errore');
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /verbi/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$verbo = $this->verbo
							->with(['articoli', 'preposizioni', 'tags'])
							->whereId($id)
							->first();

		if (is_null($verbo))
		{
			return Redirect::route('verbi.index');
		}

		return View::make('verbi.edit', compact('verbo'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /verbi/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, Verbo::rules($id), self::$messages);

		if ($validation->passes())
		{
			$verbo = $this->verbo->find($id);

			if(isset($input['articoli']))
			{
				Event::fire('articoli.save', [$verbo, $input['articoli']]);
				$input = array_except($input, 'articoli');
			}

			if(isset($input['preposizioni']))
			{
				Event::fire('preposizioni.save', [$verbo, $input['preposizioni']]);
				$input = array_except($input, 'preposizioni');
			}
			
			if(isset($input['tags']))
			{
				Event::fire('tags.save', [$verbo, $input['tags']]);
				$input = array_except($input, 'tags');
			}

			$verbo->update($input);

			return Redirect::route('verbi.index');
		}

		return Redirect::route('verbi.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'Si è verificato un errore');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /verbi/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->verbo->find($id)->delete();

		return Redirect::route('verbi.index');
	}

}