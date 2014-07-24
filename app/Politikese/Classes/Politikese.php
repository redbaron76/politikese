<?php namespace Politikese\Classes;

class Politikese {

	/**
	 * Get config form values
	 * 
	 * @param  string $key
	 * @return array
	 */
	public function forms($key)
	{
		return \Config::get('forms.' . $key);
	}

	/**
	 * Get language array from system
	 * 
	 * @return [type] [description]
	 */
	public function languages($get = 'lang')
	{
		$languages = $this->system('languages');

		foreach ($languages as $lang_key => $lang)
		{
			$langs[$lang_key] = $lang[$get];
		}

		return $langs;
	}

	/**
	 * Get config system values
	 * 
	 * @param  string $key
	 * @return string
	 */
	public function system($key)
	{
		return \Config::get('system.' . $key);
	}

}