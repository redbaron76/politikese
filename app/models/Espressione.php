<?php

class Espressione extends Eloquent {

	/**
	 * [$table description]
	 * @var string
	 */
	protected $table = 'espressioni';

	/**
	 * Timestamp needed
	 * 
	 * @var boolean
	 */
	public $timestamps = true;

	/**
	 * [$guarded description]
	 * @var [type]
	 */
	protected $guarded = ['id'];

	/**
	 * [$rules description]
	 * @var [type]
	 */
	public static function rules($id = null)
	{
		return [
			'text' => 'required|unique:espressioni,text' . ($id ? ",$id" : ''),
			'genere' => 'required',
			'numero' => 'required'
		];
	}

	/**
	 * [articoli description]
	 * @return [type] [description]
	 */
	public function articoli()
	{
		return $this->morphToMany('Articolo', 'articolabile', 'articolabili');
	}

	/**
	 * [congiunzioni description]
	 * @return [type] [description]
	 */
	public function congiunzioni()
	{
		return $this->morphToMany('Congiunzione', 'congiunzionabile', 'congiunzionabili');
	}

	/**
	 * [preposizioni description]
	 * @return [type] [description]
	 */
	public function preposizioni()
	{
		return $this->morphToMany('Preposizione', 'preposizionabile', 'preposizionabili');
	}

	/**
	 * [tags description]
	 * @return [type] [description]
	 */
	public function tags()
	{
		return $this->morphToMany('Tag', 'taggabile', 'taggabili');
	}

}