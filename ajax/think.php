<?php

require_once '../bootstrap.php';

//Connect to database
$dbh = db_connect();

// Continue session
session_start();

// Instantiate botster factory
$botster_factory = new Lenton\Botster\Factory\Botster($dbh);

//Instantiate botster object
$botster = $botster_factory->make();

//Check if conversation ID is set
if(!isset($_SESSION['conversation_id']))
{
	exit("Error: Conversation ID is not set.");
}

//Set conversation object
$conversation = $botster_factory->makeConversation();
$conversation->getConversation($_SESSION['conversation_id']);

// Let Botster respond in conversation
$botster->respond($conversation);