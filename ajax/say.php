<?php

require_once '../bootstrap.php';

//if(isset($_GET['input'])) $_POST['input'] = $_GET['input'];
if(isset($_POST['input']))
{
	//Connect to database
	$dbh = db_connect();
	
	// Continue session
	session_start();
	
	$conversation = (new Lenton\Botster\Factory\Botster($dbh))->makeConversation();
	
	//If user isn't already in a conversation
	if(!isset($_SESSION["conversation_id"]))
	{
		$conversation_id = $conversation->newConversation();
		$_SESSION['conversation_id'] = $conversation_id;
	}
	else
	{
		$conversation->getConversation($_SESSION['conversation_id']);
	}

	//Add input to the conversation
	$conversation->say(1, $_POST['input']);
}
