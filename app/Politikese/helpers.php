<?php

if ( ! function_exists('config'))
{	
	function D($value, $stop = false)
	{
		echo '<pre>' . print_r($value, true) . '</pre>';

		if($stop) die();
	}
}

if ( ! function_exists('config'))
{
	function config($key)
	{
		return Config::get('system.'.$key);
	}
}

if ( ! function_exists('politikese'))
{
	function politikese($key)
	{
		return Config::get('politikese.'.$key);
	}
}