<?php

require_once '../../bootstrap.php';

use Lentech\Botster\Factory;

//Connect to database
$dbh = db_connect();

// Instatiate repository factory
$repository_factory = new Factory\Repository($dbh);

// Make utterance repository
$utterance_repository = $repository_factory->makeUtterance();

// Output number of utterances
echo number_format($utterance_repository->count());
