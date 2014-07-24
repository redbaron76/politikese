<?php

class Congiunzione extends Eloquent {

	/**
	 * [$table description]
	 * @var string
	 */
	protected $table = 'congiunzioni';

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
	 * [espressioni description]
	 * @return [type] [description]
	 */
	/*public function espressioni()
	{
		return $this->MorphedByMany('Espressione', 'taggabile', 'taggabili');
	}*/

	/**
	 * [verbi description]
	 * @return [type] [description]
	 */
	/*public function verbi()
	{
		return $this->MorphedByMany('Verbo', 'taggabile', 'taggabili');
	}*/

}