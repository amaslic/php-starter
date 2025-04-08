<?php
require_once __DIR__ . '/../../../core/Response.php';

$userId = $GLOBALS['auth_user_id'] ?? null;

Response::json([
    'message' => 'You are authenticated!',
    'user_id' => $userId
]);
