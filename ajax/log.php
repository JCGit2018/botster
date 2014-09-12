<?php

require_once '../bootstrap.php';

session_start(); //Continue session

if(isset($_SESSION['conversation_id']))
{
	//Connect to database
	$dbh = db_connect();
	
	//Get conversation messages
	$query = $dbh->prepare('SELECT author, message FROM messages WHERE conversation = :conversation_id ORDER BY id');
	$query->execute([
		':conversation_id' => $_SESSION['conversation_id'],
	]);
	
	//Echo conversation log
	while ($message = $query->fetchObject())
	{
		if ($message->author == 0)
		{
			echo '<b><span class="author">BOT:</span> '.htmlentities($message->message).'</b><br />';
		}
		else
		{
			echo '<span class="author">YOU:</span> '.htmlentities($message->message).'<br />';
		}
	}
}
