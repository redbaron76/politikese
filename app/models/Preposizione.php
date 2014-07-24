<?php

class Preposizione extends Eloquent {

	/**
	 * [$table description]
	 * @var string
	 */
	protected $table = 'preposizioni';

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
	 * [aggettivi description]
	 * @return [type] [description]
	 */
	public function aggettivi()
	{
		return $this->MorphedByMany('Aggettivo', 'taggabile', 'taggabili');
	}

	/**
	 * [espressioni description]
	 * @return [type] [description]
	 */
	public function espressioni()
	{
		return $this->MorphedByMany('Espressione', 'taggabile', 'taggabili');
	}

	/**
	 * [verbi description]
	 * @return [type] [description]
	 */
	public function verbi()
	{
		return $this->MorphedByMany('Verbo', 'taggabile', 'taggabili');
	}

}