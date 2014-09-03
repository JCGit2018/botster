<?php

require_once '../bootstrap.php';

session_start(); //Continue session

if(isset($_SESSION['conversation_id']))
{
	//Connect to database
	db_connect();
	
	//Get conversation messages
	$mres_conversation_id = mysql_real_escape_string($_SESSION['conversation_id']);
	$res_messages = mysql_query("SELECT `author`, `message` FROM `messages` WHERE `conversation` = '".$mres_conversation_id."' ORDER BY `id`");
	
	//Echo conversation log
	while($row_messages = mysql_fetch_assoc($res_messages))
	{
		if($row_messages['author'] == 0)
		{
			echo '<b><span class="author">BOT:</span> '.htmlentities($row_messages['message']).'</b><br />';
		}
		else
		{
			echo '<span class="author">YOU:</span> '.htmlentities($row_messages['message']).'<br />';
		}
	}
}
