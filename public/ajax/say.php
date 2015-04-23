<?php

use Lentech\Botster\Factory;

require_once '../../bootstrap.php';

// Check that all data is set
if (! isset($_POST['conversation_id']) || ! isset($_POST['input']))
{
	var_dump($_POST);
	exit('Error: Some data not set.');
}

// Get data
$conversation_id = $_POST['conversation_id'];
$message = $_POST['input'];

// Continue session
session_start();

// Check that conversation ID matches session's
if (! isset($_SESSION['conversation_id']) || $conversation_id != $_SESSION['conversation_id'])
{
	exit('Error: Invalid conversation ID.');
}

// Connect to database
$dbh = db_connect();

// Instantiate interactor factory
$interactor = (new Factory\Interactor($dbh))->makeSayMessage();

// Say input in the conversation
$interactor->interact($conversation_id, $message);