<?php

require_once '../bootstrap.php';

use Lentech\Botster\Factory;

//Connect to database
$dbh = db_connect();

// Instatiate repository factory
$repository_factory = new Factory\Repository($dbh);

// Make conversation repository
$conversation_repository = $repository_factory->makeConversation();

// Output number of conversations
echo number_format($conversation_repository->count());
