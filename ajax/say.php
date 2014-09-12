<?php

require_once '../bootstrap.php';

//if(isset($_GET['input'])) $_POST['input'] = $_GET['input'];
if(isset($_POST['input']))
{
	//Connect to database
	$dbh = db_connect();
	
	// Continue session
	session_start();
	
	$botster_factory = new Lenton\Botster\Factory\Botster($dbh);
	
	//If user isn't already in a conversation
	if(!isset($_SESSION["conversation_id"]))
	{
		$conversation = $botster_factory->makeConversation();
		$_SESSION['conversation_id'] = $conversation->id;
	}
	else
	{
		$conversation = $botster_factory->makeConversation($_SESSION['conversation_id']);
	}

	//Add input to the conversation
	$conversation->say(1, $_POST['input']);
}
