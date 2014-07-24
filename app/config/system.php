<?php

return [
	
	/**
	 * 
	 */
	'project_name' => 'Politikese',
	
	/**
	 * 
	 */
	'version' => '0.0.1',

	/**
	 * Politikese :: Default language
	 */
	
	'language' => 'it',

	/**
	 * Politikese :: Available languages and directionality (ltr | rtl)
	 */
	
	'languages' => [

		'it' => [

			'file'		=> 'it',
			'lang' 		=> 'Italiano',
			'locale'	=> 'it_IT',
			'dir'		=> 'ltr',

		],

	],

	/**
	 * 
	 */
	'providers' => [

		'EventServiceProvider',

		// Dependency providers

		'Way\Generators\GeneratorsServiceProvider',

		// 'Prologue\Alerts\AlertsServiceProvider',
		// 'Intervention\Helper\DateServiceProvider',
		// 'Intervention\Helper\StringServiceProvider',
		// 'Laracasts\Utilities\UtilitiesServiceProvider',
	],

	/**
	 * 
	 */
	'facades' => [

		'Politikese' => [

			'class'	=> 'Politikese\Classes\Politikese',
			'alias'	=> 'Politikese\Support\Facades\Politikese',
			'depes' => '',

		],

	],

	/**
	 * 
	 */
	'repositories' => [

		/*'client' => [

			'method'		=> 'singleton',
			'interface' 	=> 'Politikese\Repositories\ClientRepositoryInterface',
			'class' 		=> 'Politikese\Repositories\ClientRepositoryEloquent',

		],*/



	],

	/**
	 * 
	 */
	'services' => [

		/*'searchService' => [

			'method'		=> 'singleton',
			'interface' 	=> 'Politikese\Services\Search\SearchInterface',
			'class' 		=> 'Politikese\Services\Search\Search',

		],*/

	],


];