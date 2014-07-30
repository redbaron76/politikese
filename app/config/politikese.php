<?php

return [
	
	'genere' => [

		'maschile' 	=> 'm',
		'femminile'	=> 'f'

	],

	'numero' => [

		'singolare' => 's',
		'plurale'	=> 'p'

	],

	'tempo' => [

		'presente',
		'passato'

	],

	'elementi' => [

		/*'aggettivo' => [
			'model' => 'Aggettivo',
			'field' => 'text',
			'separator' => ' '
		],*/

		'articolo' => [
			'model' => 'Articolo',
			'field' => 'text',
			'after' => ['espressione', /*'aggettivo'*/],
		],

		'avverbio' => [
			'model' => 'Avverbio',
			'field' => 'text',
			'after' => ['articolo', 'preposizione', 'gerundio', 'infinito'],
		],

		'congiunzione' => [
			'model' => 'Congiunzione',
			'field' => 'text',
			'after' => ['avverbio', 'articolo', 'gerundio', 'infinito'],
		],

		'espressione' => [
			'model' => 'Espressione',
			'field' => 'text',
			'after' => ['congiunzione', 'preposizione', 'verbo'],
		],

		'gerundio' => [
			'model' => 'Verbo',
			'field' => 'gerundio',
			'after' => ['avverbio', 'preposizione'],
		],

		'infinito' => [
			'model' => 'Verbo',
			'field' => 'infinito',
			'after' => ['avverbio', 'preposizione'],
		],

		'participio' => [
			'model' => 'Verbo',
			'field' => 'partpassato',
			'after' => ['articolo', 'preposizione'],
		],

		'preposizione' => [
			'model' => 'Preposizione',
			'field' => 'text',
			'after'	=>['espressione'],
		],

		'verbo' => [
			'model' => 'Verbo',
			'field' => '',
			'after'	=>['espressione', 'infinito'],
		],

	],


	'incipit' => [

		'random' => ['articolo', 'avverbio', 'gerundio', 'infinito', 'preposizione'],

		'next' => [

		]

	]

];