<?php

class Articolo extends Eloquent {

	/**
	 * [$table description]
	 * @var string
	 */
	protected $table = 'articoli';

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
	 * [tags description]
	 * @return [type] [description]
	 */
	public function tags()
	{
		return $this->morphToMany('Tag', 'taggabile', 'taggabili');
	}

}