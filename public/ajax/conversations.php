<?php

require_once '../../bootstrap.php';

use Lentech\Botster\Factory\RepositoryFactory;

//Connect to database
$dbh = db_connect();

// Make conversation repository
$conversation_repository = (new RepositoryFactory($dbh))->makeConversation();

// Output number of conversations
echo number_format($conversation_repository->count());
