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
	 * [$rules description]
	 * @var [type]
	 */
	public static function rules($id = null)
	{
		return [
			'infinito' => 'required|unique:verbi,infinito' . ($id ? ",$id" : '')
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

	// STATIC METHODS per i verbi

	public static function gerundio($infinito)
	{
		return substr_replace($infinito, 'ndo', -2);
	}
	
	public static function presente1s($infinito)
	{
		return substr_replace($infinito, 'o', -3);
	}
	
	public static function presente3s($infinito)
	{
		return substr_replace($infinito, 'a', -3);
	}
	
	public static function presente1p($infinito)
	{
		return substr_replace($infinito, 'iamo', -3);
	}

	public static function presente3p($infinito)
	{
		return substr_replace($infinito, 'ano', -3);
	}
	
	public static function passato1s($infinito)
	{
		return substr_replace($infinito, 'vo', -2);
	}
	
	public static function passato3s($infinito)
	{
		return substr_replace($infinito, 'va', -3);
	}

	public static function passato1p($infinito)
	{
		return substr_replace($infinito, 'avamo', -3);
	}
	
	public static function passato3p($infinito)
	{
		return substr_replace($infinito, 'avano', -3);
	}
	
	public static function riflessivo($function, $infinito, $prep)
	{
		return  $prep . ' ' . call_user_func($function, $infinito);
	}
	
	public static function partpresente($infinito)
	{
		if(substr($infinito, -3) == 'are')
		{
			return substr_replace($infinito, 'ante', -3);
		}
		else
		{
			return substr_replace($infinito, 'ente', -3);
		}		
	}
	
	public static function partpassato($infinito)
	{
		if(substr($infinito, -3) == 'are')
		{
			return substr_replace($infinito, 'ato', -3);
		}
		elseif(substr($infinito, -3) == 'ere')
		{
			return substr_replace($infinito, 'uto', -3);
		}
		else
		{
			return substr_replace($infinito, 'ito', -3);
		}		
	}
	
	public static function congiuntivo($infinito, $tempo)
	{
		if(substr($infinito, -3) == 'are')
		{
			switch ($tempo) {
				case '1s':
					return substr_replace($infinito, 'i', -3);
					break;
				case '3s':
					return substr_replace($infinito, 'i', -3);
					break;
				case '1p':
					return substr_replace($infinito, 'iamo', -3);
					break;
				case '3p':
					return substr_replace($infinito, 'ino', -3);
					break;
			}
		}
		else
		{
			switch ($tempo) {
				case '1s':
					return substr_replace($infinito, 'a', -3);
					break;
				case '3s':
					return substr_replace($infinito, 'a', -3);
					break;
				case '1p':
					return substr_replace($infinito, 'iamo', -3);
					break;
				case '3p':
					return substr_replace($infinito, 'ano', -3);
					break;
			}
		}		
	}

}