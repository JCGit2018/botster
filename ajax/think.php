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
$botster->conversation = new Lenton\Botster\Conversation($_SESSION['conversation_id']);

//Get input
if(($previous_message = $botster->conversation->getMessage(0)) === false || $previous_message['author'] != 1) exit();
$input = $previous_message['message'];

// Get Botster's response for input
$response = $botster->respond($input);

//Say output
$botster->say($response);