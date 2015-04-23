<?php

require_once '../../bootstrap.php';

//Connect to database
$dbh = db_connect();

// Continue session
session_start();

//Check if conversation ID is set
if(!isset($_SESSION['conversation_id']))
{
	exit("Error: Conversation ID is not set.");
}

// Instantiate interactor factory
$interactor_factory = new Lentech\Botster\Factory\Interactor($dbh);

// Let Botster respond in conversation
$let_respond_interactor = $interactor_factory->makeLetRespond();
$let_respond_interactor->interact($_SESSION['conversation_id']);