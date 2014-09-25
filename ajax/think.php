<?php

require_once '../bootstrap.php';

//Connect to database
$dbh = db_connect();

// Continue session
session_start();

//Check if conversation ID is set
if(!isset($_SESSION['conversation_id']))
{
	exit("Error: Conversation ID is not set.");
}

//Instantiate botster object
$botster = (new Lentech\Botster\Factory\Botster($dbh))->make();

// Let Botster respond in conversation
$botster->respond($_SESSION['conversation_id']);