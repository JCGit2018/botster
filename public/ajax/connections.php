<?php

require_once '../../bootstrap.php';

use Lentech\Botster\Factory\RepositoryFactory;

//Connect to database
$dbh = db_connect();

// Make connection repository
$connection_repository = (new RepositoryFactory($dbh))->makeConnection();

// Output number of connections
echo number_format($connection_repository->count());
