<?php

require_once '../../bootstrap.php';

use Lentech\Botster\Factory;

//Connect to database
$dbh = db_connect();

// Instatiate repository factory
$repository_factory = new Factory\Repository($dbh);

// Make connection repository
$connection_repository = $repository_factory->makeConnection();

// Output number of connections
echo number_format($connection_repository->count());
