<?php require_once '../bootstrap.php'; ?>
<!doctype html>
<html>
	<head>
		<title>Botster - Chatbot Artificial Intelligence</title>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, user-scalable=no">
		<meta name="description" content="Botster is an online chatbot artificial intelligence which learns from the conversations it has with users on the Internet." />
		<link rel="shortcut icon" href="<?=DOMAIN_ROOT?>images/logo_16.png" />
		<link rel="stylesheet" href="<?=DOMAIN_ROOT?>css/style.css" />
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script type="text/javascript" src="<?=DOMAIN_ROOT?>mustache/mustache.js"></script>
		<script type="text/javascript" src="<?=DOMAIN_ROOT?>javascript.js"></script>
	</head>
	<body>
        <script>
            var config = {
                domainRoot: '<?=DOMAIN_ROOT?>',
                analyticsId: '<?=$settings['analytics_id']?>',
            }
        </script>
		<script type="text/javascript" src="<?=DOMAIN_ROOT?>google_analytics.js"></script>
		<header class="main">
			<img src="<?=DOMAIN_ROOT?>images/logo.png" class="logo" alt="" />
			<h1>Botster</h1>
			<div class="information">
				<p>Hello there, my name's Botster and I'm an open-source chatbot artificial intelligence! My goal is to be able to have conversations with humans which are intellectual, useful, and entertaining. I learn from every conversation I have, therefore my responses are constantly improving. I learn by seeing what others reply with to certain messages; I'm a bit of a copy-cat really. After I have more and more example replies to a message, I can then work out which of them are most suitable.</p>
				<div class="links">
					<a href="https://github.com/lentech/botster" target="_blank">
						<img src="<?=DOMAIN_ROOT?>images/github_icon.png" alt="GitHub" />
					</a>
				</div>
			</div>
			<a href="http://lentech.org" target="_blank" class="organisation">
				<img src="<?=DOMAIN_ROOT?>images/lentech_logo.png" alt="Lentech" />
			</a>
		</header>
		<div class="stats">
			<span title="People Chatting" class="stat">
				<div class="title">People Chatting</div>
				<img src="<?=DOMAIN_ROOT?>images/online.png" alt="" class="icon" />
				<span id="online" class="number"></span>
			</span>
			<span title="Conversations Had" class="stat">
				<div class="title">Conversations Had</div>
				<img src="<?=DOMAIN_ROOT?>images/conversations.png" alt="" class="icon" />
				<span id="conversations" class="number"></span>
			</span>
			<span title="Unique Utterances" class="stat">
				<div class="title">Unique Utterances</div>
				<img src="<?=DOMAIN_ROOT?>images/quotation_mark.png" alt="" class="icon" />
				<span id="utterances" class="number"></span>
			</span>
			<span title="Utterance Connections" class="stat">
				<div class="title">Utterance Connections</div>
				<img src="<?=DOMAIN_ROOT?>images/connections.png" alt="" class="icon" />
				<span id="connections" class="number"></span>
			</span>
		</div>
		<div class="chat">
			<div id="messages" class="messages"></div>
			<div class="input">
				<input type="text" maxlength="100" autocomplete="off" x-webkit-speech id="input" class="text-box" />
				<input type="button" value="Say" id="submit" class="say-button" />
			</div>
		</div>
	</body>
</html>
