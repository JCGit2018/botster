<?php

require_once '../bootstrap.php';

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

//Set conversation object
$conversation = new Lenton\Botster\Conversation($_SESSION['conversation_id']);

// Get Botster's response to conversation
$response = $botster->respond($conversation);

// If Botster made a response
if ($response !== false)
{
	//Say output
	$botster->say($response);
}