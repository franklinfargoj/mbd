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
			'R'  => 'Kruti_Dev_010.ttf',    // regular font
			'B'  => 'Kruti_Dev_010.ttf',       // optional: bold font
			'I'  => 'Kruti_Dev_010.ttf',     // optional: italic font
			'BI' => 'Kruti_Dev_010.ttf', // optional: bold-italic font
			//'useOTL' => 0xFF,    
			//'useKashida' => 75, 
		]
		// ...add as many as you want.
	]

];
