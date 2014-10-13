<?php

use Lentech\Botster\Factory;

require_once '../bootstrap.php';

// Connect to database
$dbh = db_connect();

// Instantiate start conversation interactor
$interactor = (new Factory\Interactor($dbh))->makeStartConversation();

// Get user information
$ip = $_SERVER['REMOTE_ADDR'];
$user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';

// Start new conversation
$conversation_id = $interactor->interact($ip, $user_agent);

// Store conversation ID in session
session_start();
$_SESSION['conversation_id'] = $conversation_id;

// Return JSON data
echo json_encode(['conversation_id' => $conversation_id]);