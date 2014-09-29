<?php

require_once '../bootstrap.php';

// If input is set
if (isset($_POST['input']))
{
	// Get input
	$input = $_POST['input'];
	
	// Connect to database
	$dbh = db_connect();
	
	// Continue session
	session_start();
	
	// Instantiate interactor factory
	$interactor_factory = new Lentech\Botster\Factory\Interactor($dbh);
	
	// If user is already in a conversation
	if (isset($_SESSION["conversation_id"]))
	{
		// Get conversation ID
		$conversation_id = $_SESSION['conversation_id'];
	}
	else
	{
		// Get user information
		$ip = $_SERVER['REMOTE_ADDR'];
		$user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
		
		// Start new conversation
		$start_conversation_interactor = $interactor_factory->makeStartConversation();
		$conversation_id = $start_conversation_interactor->interact($ip, $user_agent);
		$_SESSION['conversation_id'] = $conversation_id;
	}

	// Say input in the conversation
	$say_message_interactor = $interactor_factory->makeSayMessage();
	$say_message_interactor->interact($conversation_id, $input);
}
