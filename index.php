<?php

require_once 'bootstrap.php';

//Start session
session_start(); 
?>
<!doctype html>
<html>
<head>
	<title>Botster - Chatbot Artificial Intelligence</title>
    <meta charset="UTF-8" />
    <meta name="description" content="Botster is an online chatbot artificial intelligence which learns from the conversations it has with users on the Internet." />
	<meta name="viewport" content="width=336, initial-scale=1" />
    <link rel="shortcut icon" href="<?=DOMAIN_ROOT?>images/icon.png" />
    <link rel="stylesheet" href="<?=DOMAIN_ROOT?>style.css" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script type="text/javascript" src="<?=DOMAIN_ROOT?>mustache/mustache.js"></script>
	<script type="text/javascript" src="<?=DOMAIN_ROOT?>settings.js"></script>
    <script type="text/javascript" src="<?=DOMAIN_ROOT?>javascript.js"></script>
</head>
<body>
	<script type="text/javascript" src="<?=DOMAIN_ROOT?>google_analytics.js"></script>
	<div id="content">
		<div id="stats">
			<div class="left">
				<span title="People Chatting" class="stat">
					<img src="<?=DOMAIN_ROOT?>images/online.png" alt="People Chatting: " /><span id="online" class="number"></span>
				</span>
				<span title="Conversations Had" class="stat">
					<img src="<?=DOMAIN_ROOT?>images/conversations.png" alt="Conversations Had: " /><span id="conversations" class="number"></span>
				</span>
				<span title="Unique Utterances" class="stat">
					<img src="<?=DOMAIN_ROOT?>images/quotation_mark.png" alt="Unique Utterances: " /><span id="utterances" class="number"></span>
				</span>
				<span title="Utterance Connections" class="stat">
					<img src="<?=DOMAIN_ROOT?>images/connections.png" alt="Utterance Connections: " /><span id="connections" class="number"></span>
				</span>
			</div>
			<div class="right">
				<a href="javascript:newConversation()" class="stat"><img src="<?=DOMAIN_ROOT?>images/bin.png" alt="New Conversation" title="New Conversation" /></a>
			</div>
		</div>
		<div id="messages"></div>
		<a href="javascript:say()" class="button" id="submit">Say</a>
		<div id="input_div"><input type="text" id="input" onkeydown="checkEnter(event, 'say')" maxlength="100" autocomplete="off" x-webkit-speech onwebkitspeechchange="say()" /></div>
	</div>
</body>
</html>
