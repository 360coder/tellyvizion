<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Number of results to show per page
	|--------------------------------------------------------------------------
	|
	| To Use, simply call Config::get('site.num_results_per_page');
	|
	*/

	'uploads_url' => '/content/uploads/',
	'uploads_dir' => '/content/uploads/',
	'uploads_path' => '/var/www/html/content/uploads/',
	's3_video' => 'https://s3.amazonaws.com/tellyvizion/uploads/',
	'media_upload_function' => 'ImageHandler::upload',
	'media_upload_function_video' => 'VideoHandler::upload',
	'num_results_per_page' => 15,
);