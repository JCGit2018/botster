<?php

error_reporting(E_ALL & ~E_DEPRECATED);

// Include composer autoloading
require 'vendor/autoload.php';

// Include settings
require 'settings.php';

define('DOMAIN_ROOT', $settings['domain_root']);

function db_connect()
{
	$mysql = $GLOBALS['settings']['mysql'];
	
	mysql_connect($mysql['host'], $mysql['username'], $mysql['password']);
	mysql_select_db($mysql['database']);
}