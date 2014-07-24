<?php

class Verbo extends Eloquent {

	/**
	 * [$table description]
	 * @var string
	 */
	protected $table = 'verbi';

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