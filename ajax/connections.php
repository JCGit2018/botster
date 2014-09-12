<?php

require_once '../bootstrap.php';

//Connect to database
$dbh = db_connect();

//Get number of inputs and outputs
$query = $dbh->query("SELECT COUNT(*) AS count FROM connections");
$row = $query->fetchObject();

//Echo number of items
echo number_format($row->count);
