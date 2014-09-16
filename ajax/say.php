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
	$conversation = $botster_factory->makeConversation();
	$botster = $botster_factory->make();
	
	//If user isn't already in a conversation
	if(!isset($_SESSION["conversation_id"]))
	{
		//Get user information
		$ip = $_SERVER['REMOTE_ADDR'];
		$user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
		
		$conversation_id = $conversation->newConversation($ip, $user_agent);
		$_SESSION['conversation_id'] = $conversation_id;
	}
	else
	{
		$conversation->getConversation($_SESSION['conversation_id']);
	}

	//Add input to the conversation
	$botster->say($conversation->id, 1, $_POST['input']);
}
