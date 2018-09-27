<?php

return [
	'mode'                  => 'utf-8',
	'format'                => 'A4',
	'author'                => '',
	'subject'               => '',
	'keywords'              => '',
	'creator'               => 'Laravel Pdf',
	'display_mode'          => 'fullpage',
	'tempDir'               => base_path('../temp/'),
	'font_path' => base_path('resources/fonts/'),
	'font_data' => [
		'marathi' => [
			'R'  => 'vakra-marathi-font.ttf',    // regular font
			'B'  => 'vakra-marathi-font.ttf',       // optional: bold font
			'I'  => 'vakra-marathi-font.ttf',     // optional: italic font
			'BI' => 'vakra-marathi-font.ttf', // optional: bold-italic font
			'useOTL' => 0xFF,    
			'useKashida' => 75, 
		]
		// ...add as many as you want.
	]

];
