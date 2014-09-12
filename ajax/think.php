<?php

require_once '../bootstrap.php';

//Connect to database
$dbh = db_connect();

// Continue session
session_start();

//Instantiate botster object
$botster = (new Lenton\Botster\Factory\Botster($dbh))->make();

//Check if conversation ID is set
if(!isset($_SESSION['conversation_id']))
{
	exit("Error: Conversation ID is not set.");
}

//Set conversation object
$conversation = new Lenton\Botster\Conversation($dbh, $_SESSION['conversation_id']);

// Let Botster respond in conversation
$botster->respond($conversation);