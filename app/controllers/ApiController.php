<?php

class ApiController extends BaseController {

	/**
	 * [$articolo description]
	 * @var [type]
	 */
	protected $articolo;

	/**
	 * [$preposizione description]
	 * @var [type]
	 */
	protected $preposizione;
	/**
	 * [$espressione description]
	 * @var [type]
	 */
	protected $tag;

	/**
	 * [__construct description]
	 * @param Espressione $espressione [description]
	 */
	public function __construct(Articolo $articolo, Preposizione $preposizione, Tag $tag)
	{
		$this->articolo = $articolo;
		$this->preposizione = $preposizione;
		$this->tag = $tag;
	}

	public function getArticoli()
	{
		$q = Input::get('q');

		return $this->articolo
					->where('text', 'like', $q.'%')
					->orderBy('text', 'asc')
					->take(5)
					->get(['articoli.id', 'text']);
	}

	public function getPreposizioni()
	{
		$q = Input::get('q');

		return $this->preposizione
					->where('text', 'like', $q.'%')
					->orderBy('text', 'asc')
					->take(5)
					->get(['preposizioni.id', 'text']);
	}

	public function getTags()
	{
		$q = Input::get('q');

		return $this->tag
					->where('text', 'like', $q.'%')
					->orderBy('text', 'asc')
					->take(5)
					->get(['tags.id', 'text']);
	}

}