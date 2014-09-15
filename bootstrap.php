<?php

error_reporting(E_ALL);

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
	
	$dbh = new PDO('mysql:host='.$mysql['host'].';dbname='.$mysql['database'], $mysql['username'], $mysql['password']);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbh;
}