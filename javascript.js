/**
 * ID of the current conversation.
 */
conversationId = null;

/**
 * The last message ID retrieved.
 */
lastMessageId = null;

/**
 * Runs on document load.
 */
$(document).ready(function() {
	focusInput();
	updateStatsLoop();
});

/**
 * Scrolls a div to the bottom.
 * 
 * @param {object} div DOM object
 * @return {void}
 */
function scrollToBottom(div)
{
	div.scrollTop = div.scrollHeight;
	div.scrollTop = div.scrollHeight;
}

/**
 * Checks if enter has been pressed, and executes a function if it was.
 * 
 * @param e Event
 * @param {string} func Function to execute
 */
function checkEnter(e, func)
{
	var keyCode = e ? (e.which ? e.which : e.keyCode) : e.keyCode;
	if(keyCode == 13) { eval(func+'();'); }
}

/**
 * Appends messages to the chatbox.
 * 
 * @param {object} data Messages array
 * @return {void}
 */
function appendMessages(data)
{
	// Get template
	$.get(domainRoot+'templates/messages.mst', function(template) {
		// Set author booleans
		$.each(data.messages, function(index, message) {
			if (message.author === 0) {
				data.messages[index].robot = true;
			}
			else {
				data.messages[index].human = true;
			}
		});
		
		// Render data using template
		var rendered = Mustache.render(template, data);

		// Append message to chat
		var div = document.getElementById('messages');
		div.innerHTML = div.innerHTML + rendered;

		// Scroll chat to bottom
		scrollToBottom(div);
	});
}

/**
 * Says a message as the user.
 * 
 * @return {boolean}
 */
function say()
{
	// If a conversation hasn't been started yet
	if (conversationId === null)
	{
		// Start a new conversation
		newConversation();
	}
	
	// Filter input
	var input = document.getElementById('input').value.replace(/^\s+|\s+$/g, '');

	// If input is empty
	if (input === '')
	{
		return false;
	}

	// Disable input and submit
	var messageInput = document.getElementById('input');
	var sayButton = document.getElementById('submit');
	messageInput.disabled = true;
	sayButton.disabled = true;
	messageInput.value = '';

	// Build data to send
	$data = {
		"conversation_id": conversationId,
		"input": input
	};

	// Post data to server
	$.post(domainRoot+'ajax/say.php', $data, function(response) {
		// If there was an error
		if (response !== '')
		{
			// Alert it
			alert(response);
		}

		// Update
		getLog(function() {
			// Let Botster respond
			think();
		});
		updateStat('conversations');
	});
}

/**
 * Lets botster respons to conversation.
 */
function think()
{
	$.post(domainRoot+'ajax/think.php', function(response) {
		// If there was an error
		if (response !== '')
		{
			// Alert it
			alert(response);
		}
		
		// Update log
		getLog(function(){
			// Enable input and submit
			var messageInput = document.getElementById('input');
			var sayButton = document.getElementById('submit');
			messageInput.disabled = false;
			sayButton.disabled = false;
			messageInput.focus();
		});
		
		// Update stats
		updateStat('utterances');
		updateStat('connections');
	});
}

/**
 * Gets any new messages in the conversation and appends them to the chatbox.
 * 
 * @param {function} callback Function to call when done
 * @return {void}
 */
function getLog(callback)
{
	$url = domainRoot+'ajax/log.php';
	
	// If last message ID has been set
	if (lastMessageId !== null)
	{
		// Append last message ID as GET variable
		$url = $url+'?last='+lastMessageId;
	}
	
	$.getJSON($url, function(data) {
		// If there are new messages
		if (data.messages.length !== 0)
		{
			// Add new messages
			appendMessages(data);

			// Update last message ID
			lastMessageId = data.messages[data.messages.length-1].id;
		}
		
		callback();
	});
}

/**
 * Starts a new conversation.
 * 
 * @return {void}
 */
function newConversation()
{
	var request = new XMLHttpRequest();
	request.onload = function() {
		// Decode data
		var data = JSON.parse(request.responseText);
		
		// Set conversation ID
		conversationId = data.conversation_id;
	};
	request.open('get', domainRoot+'ajax/new_conversation.php', false);
	request.send();
}

/**
 * Focuses on the message input field.
 * 
 * @return {void}
 */
function focusInput()
{
	document.getElementById('input').focus();
}

/**
 * Starts a loop which updates all stats every 10 seconds.
 * 
 * @return {void}
 */
function updateStatsLoop()
{
	updateStat('online');
	updateStat('conversations');
	updateStat('utterances');
	updateStat('connections');
	
	setTimeout("updateStatsLoop()", 10000);
}

/**
 * Updates a statistic on the page.
 * 
 * @param {string} name Name of the statistic
 * @returns {void}
 */
function updateStat(name)
{
	$.get(domainRoot+'ajax/'+name+'.php', function(data) {
		$("#"+name).html(data);
	});
}