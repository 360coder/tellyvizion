<?php

use Aws\S3\S3Client;
/* $s3 = new S3Client([
    'version' => 'latest',
    'region'  => 'us-west-2'
]); */


require_once 'vendor/autoload.php';

$config = require('config.php');


$s3 = S3Client::factory ([
	'key' => $config['s3']['key'],
	'secret' => $config['s3']['secret']
]);