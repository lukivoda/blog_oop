<?php

define('INC_ROOT', dirname(__DIR__));

require INC_ROOT . '/vendor/autoload.php';

define('ASSET_ROOT',
	'http://' . $_SERVER['HTTP_HOST'] .
	str_replace($_SERVER['DOCUMENT_ROOT'], '', str_replace('\\', '/', INC_ROOT) . '/public')
);