<?php

class TagsController extends BaseController {

	/**
	 * [$tag description]
	 * @var [type]
	 */
	protected $tag;

	/**
	 * [$messages description]
	 * @var [type]
	 */
	public static $messages = [
		'required' => 'Il campo :attribute è obbligatorio',
		'unique' => 'Questo tag è già presente',
	];

	/**
	 * [__construct description]
	 * @param Espressione $avverbio [description]
	 */
	public function __construct(Tag $tag)
	{
		$this->beforeFilter('auth.basic');
		$this->tag = $tag;
	}

	/**
	 * Display a listing of the resource.
	 * GET /tags
	 *
	 * @return Response
	 */
	public function index()
	{
		$tags = $this->tag->orderBy('text', 'asc')->paginate(20);

		return View::make('tags.index', compact('tags'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /tags/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('tags.edit');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /tags
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Tag::rules(), self::$messages);

		if ($validation->passes())
		{
			$tag_new = [
				'text' => $input['text'],
			];

			$tag = $this->tag->create($tag_new);

			return Redirect::route('tags.index');
		}

		return Redirect::route('tags.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'Si è verificato un errore');
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /tags/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$tag = $this->tag->whereId($id)
						 ->first();

		if (is_null($tag))
		{
			return Redirect::route('tags.index');
		}

		return View::make('tags.edit', compact('tag'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /tags/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, Tag::rules($id), self::$messages);

		if ($validation->passes())
		{
			$tag = $this->tag->find($id);

			$tag->update($input);

			return Redirect::route('tags.index');
		}

		return Redirect::route('tags.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'Si è verificato un errore');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /tags/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->tag->find($id)->delete();

		return Redirect::route('tags.index');
	}

}