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
	'font_path' 			=> base_path('resources/lang/marathi_font/'),
	'font_data'				=> [
			'marathi_fonts' => [
				'R' => 'Shiv05.ttf'
			]					
	]
];
