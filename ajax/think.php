<?php

require_once '../bootstrap.php';

function mtime()
{
	$exploded = explode(" ", microtime());
	return $exploded[0] + $exploded[1];
}

$start = mtime();

//Connect to database
db_connect();

// Continue session
session_start();

//Instantiate botster object
$botster = (new Lenton\Botster\Factory\Botster)->make();

//Check if conversation ID is set
if(!isset($_SESSION['conversation_id']))
{
	exit("Error: Conversation ID is not set.");
}
//$botster->log('Conversation ID: '.$_SESSION['conversation_id']);

//Set conversation object
$botster->conversation = new Lenton\Botster\Conversation($_SESSION['conversation_id']);

//Get input
if(($previous_message = $botster->conversation->getMessage(0)) === false || $previous_message['author'] != 1) exit();
$input = $previous_message['message'];
	
$botster->log('Input: '.$input);

// Get Botster's response for input
$response = $botster->respond($input);

$finish = mtime();

$execution_time = $finish - $start;
$botster->log('Script executed in ' . $execution_time . ' seconds.');

//Say output
$botster->say($response);