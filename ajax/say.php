<?php

require_once '../bootstrap.php';

//if(isset($_GET['input'])) $_POST['input'] = $_GET['input'];
if(isset($_POST['input']))
{
	//Connect to database
	db_connect();
	
	// Continue session
	session_start();
	
	//If user isn't already in a conversation
	if(!isset($_SESSION["conversation_id"]))
	{
		$conversation = new Lenton\Botster\Conversation();
		$_SESSION['conversation_id'] = $conversation->id;
	}
	else
	{
		$conversation = new Lenton\Botster\Conversation($_SESSION['conversation_id']);
	}

	//Add input to the conversation
	$conversation->say(1, $_POST['input']);
}
