<?php

error_reporting(E_ALL & ~E_DEPRECATED);

// Include composer autoloading
require 'vendor/autoload.php';

// Include settings
require 'settings.php';

define('DOMAIN_ROOT', $settings['domain_root']);

/**
 * Connects to the database.
 * 
 * @return \PDO Database connection
 */
function db_connect()
{
	$mysql = $GLOBALS['settings']['mysql'];
	
	return new PDO('mysql:host='.$mysql['host'].';dbname='.$mysql['database'], $mysql['username'], $mysql['password']);
}