<?php

require_once '../bootstrap.php';

use Lentech\Botster\Factory;

//Connect to database
$dbh = db_connect();

// Instatiate repository factory
$repository_factory = new Factory\Repository($dbh);

// Make input repository
$input_repository = $repository_factory->makeInput();

// Output number of inputs
echo number_format($input_repository->count());
