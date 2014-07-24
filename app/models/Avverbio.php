<?php

class Avverbio extends Eloquent {

	/**
	 * [$table description]
	 * @var string
	 */
	protected $table = 'avverbi';

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