<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

// INIT JS
Route::get('init.js', array('uses' => 'BaseController@init', 'as' => 'js.init'));

// ESPRESSIONI
Route::resource('espressioni', 'EspressioniController');

// API CALLS
Route::post('api/articoli', array('uses' => 'ApiController@getArticoli', 'as' => 'api.articoli'));
Route::post('api/preposizioni', array('uses' => 'ApiController@getPreposizioni', 'as' => 'api.preposizioni'));
Route::post('api/tags', array('uses' => 'ApiController@getTags', 'as' => 'api.tags'));
