<?php

require_once '../bootstrap.php';

use Lentech\Botster\Factory;
use Lentech\Botster\Entity\Message;

// Continue session
session_start();

// If conversation ID is set
if (isset($_SESSION['conversation_id']))
{
	// Get conversation ID
	$conversation_id = $_SESSION['conversation_id'];
	
	// Get database handler
	$dbh = db_connect();
	
	// Instantiate message repository
	$message_repository = (new Factory\Repository($dbh))->makeMessage();
	
	// Get conversation messages
	$messages = array_reverse($message_repository->getLatestInConversation($conversation_id));
	
	// Output conversation log
	foreach ($messages as $message)
	{
		// If author is user
		if ($message->author == Message::USER)
		{
			echo '<span class="author">YOU:</span> '.htmlentities($message->message).'<br />';
		}
		else
		{
			echo '<b><span class="author">BOT:</span> '.htmlentities($message->message).'</b><br />';
		}
	}
}
