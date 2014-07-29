<?php

class Tag extends Eloquent {
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tags';

	/**
	 * Timestamp needed
	 * 
	 * @var boolean
	 */
	public $timestamps = true;

	/**
	 * Guarded mass-assignment property
	 * 
	 * @var array
	 */
	protected $guarded = ['id'];

	/**
	 * [$rules description]
	 * @var [type]
	 */
	public static function rules($id = null)
	{
		return [
			'text' => 'required|unique:tags,text' . ($id ? ",$id" : '')
		];
	}

	/**
	 * [aggettivi description]
	 * @return [type] [description]
	 */
	public function aggettivi()
	{
		return $this->MorphedByMany('Aggettivo', 'taggabile', 'taggabili');
	}

	/**
	 * [avverbi description]
	 * @return [type] [description]
	 */
	public function avverbi()
	{
		return $this->MorphedByMany('Avverbio', 'taggabile', 'taggabili');
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