//////////////////////
// Helper functions //
//////////////////////

function rand(minVal, maxVal, floatVal)
{
	var randVal = minVal+(Math.random()*(maxVal-minVal));
	return typeof floatVal == 'undefined'?Math.round(randVal):randVal.toFixed(floatVal);
}

////////////////////////
// Chat functionality //
////////////////////////

function checkEnter(e, func)
{
	var keyCode = e ? (e.which ? e.which : e.keyCode) : e.keyCode;
	if(keyCode == 13) { eval(func+'();'); }
}

function say()
{
	var input = document.getElementById('input').value.replace(/^\s+|\s+$/g, '');
	if(input != '')
	{
		//Disable input and submit
		document.getElementById('input').disabled = true;
		document.getElementById('submit').disabled = true;
		document.getElementById('input').value = '';

		xmlhttp1 = new XMLHttpRequest();
		xmlhttp1.onreadystatechange = function()
		{
			if(xmlhttp1.readyState == 4 && xmlhttp1.status == 200)
			{
				// If there was an error
				if(xmlhttp1.responseText != '')
				{
					// Alert it
					alert(xmlhttp1.responseText);
				}
				
				getLog();
				updateStats();
				think();
			}
		}
		xmlhttp1.open('POST', domainRoot+'ajax/say.php', true);
		xmlhttp1.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		xmlhttp1.send('input='+encodeURIComponent(input));
	}
}

function think()
{
	xmlhttp2 = new XMLHttpRequest();
	xmlhttp2.onreadystatechange = function()
	{
		if(xmlhttp2.readyState == 4 && xmlhttp2.status == 200)
		{
			if(xmlhttp2.responseText != '')
			{
				alert(xmlhttp2.responseText);
			}
			getLog();
			document.getElementById('input').disabled = false;
			document.getElementById('submit').disabled = false;
			document.getElementById('input').focus();
			updateStats();
		}
	}
	xmlhttp2.open('POST', domainRoot+'ajax/think.php', true);
	xmlhttp2.send();
}

function getLog()
{
	xmlhttp3 = new XMLHttpRequest();
	xmlhttp3.onreadystatechange = function()
	{
		if(xmlhttp3.readyState == 4 && xmlhttp3.status == 200)
		{
			var logDiv = document.getElementById('messages');
			
			//Update chat log
			logDiv.innerHTML = xmlhttp3.responseText;

			//Scroll chat box
			logDiv.scrollTop = logDiv.scrollHeight;
			logDiv.scrollTop = logDiv.scrollHeight;
		}
	}
	xmlhttp3.open("GET", domainRoot+'ajax/log.php', true);
	xmlhttp3.send();
}

function newConversation()
{
	xmlhttp5 = new XMLHttpRequest();
	xmlhttp5.onreadystatechange = function()
	{
		if(xmlhttp5.readyState == 4 && xmlhttp5.status == 200)
		{
			getLog();
			focusInput();
		}
	}
	xmlhttp5.open('POST', domainRoot+'ajax/new.php', true);
	xmlhttp5.send();
}

function focusInput()
{
	document.getElementById('input').focus();
}

/////////////////////////
// Stats functionality //
/////////////////////////

function updateStatsLoop()
{
	updateStats();
	setTimeout("updateStatsLoop()", 10000); //10 seconds
}

function updateStats()
{
	getOnline();
	getConversations();
	getInputs();
	getConnections();
}

function getOnline()
{
	xmlhttp4 = new XMLHttpRequest();
	xmlhttp4.onreadystatechange = function()
	{
		if(xmlhttp4.readyState == 4 && xmlhttp4.status == 200)
		{
			document.getElementById("online").innerHTML = xmlhttp4.responseText;
		}
	}
	xmlhttp4.open("GET", domainRoot+'ajax/online.php', true);
	xmlhttp4.send();
}

function getConversations()
{
	xmlhttp6 = new XMLHttpRequest();
	xmlhttp6.onreadystatechange = function()
	{
		if(xmlhttp6.readyState == 4 && xmlhttp6.status == 200)
		{
			document.getElementById("conversations").innerHTML = xmlhttp6.responseText;
		}
	}
	xmlhttp6.open("GET", domainRoot+'ajax/conversations.php', true);
	xmlhttp6.send();
}

function getInputs()
{
	xmlhttp7 = new XMLHttpRequest();
	xmlhttp7.onreadystatechange = function()
	{
		if (xmlhttp7.readyState == 4 && xmlhttp7.status == 200)
		{
			document.getElementById('inputs').innerHTML = xmlhttp7.responseText;
		}
	}
	xmlhttp7.open('GET', domainRoot+'ajax/inputs.php', true);
	xmlhttp7.send();
}

function getConnections()
{
	xmlhttp8 = new XMLHttpRequest();
	xmlhttp8.onreadystatechange = function()
	{
		if (xmlhttp8.readyState == 4 && xmlhttp8.status == 200)
		{
			document.getElementById('connections').innerHTML = xmlhttp8.responseText;
		}
	}
	xmlhttp8.open('GET', domainRoot+'ajax/connections.php', true);
	xmlhttp8.send();
}