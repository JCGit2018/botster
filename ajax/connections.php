<?php

require_once '../bootstrap.php';

//Connect to database
db_connect();

//Get number of inputs and outputs
$connections = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM `connections`"));

//Echo number of items
echo number_format($connections[0]);
