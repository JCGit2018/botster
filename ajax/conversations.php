<?php

require_once '../bootstrap.php';

//Connect to database
db_connect();

//Get number of inputs and outputs
$conversations = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM `conversations`"));

//Echo number of items
echo number_format($conversations[0]);
