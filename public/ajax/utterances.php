<?php

require_once '../../bootstrap.php';

use Lentech\Botster\Factory\RepositoryFactory;

//Connect to database
$dbh = db_connect();

// Make utterance repository
$utterance_repository = (new RepositoryFactory($dbh))->makeUtterance();

// Output number of utterances
echo number_format($utterance_repository->count());
