<?php

require_once '../bootstrap.php';

//Connect to database
db_connect();

//Get number of inputs and outputs
$inputs = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM `inputs`"));

//Echo number of items
echo number_format($inputs[0]);
