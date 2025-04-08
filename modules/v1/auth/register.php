<?php

require_once __DIR__ . '/../../core/Database.php';
require_once __DIR__ . '/../../core/Response.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['email'], $data['password'])) {
    Response::json(['error' => 'Email and password required'], 400);
}

$email = filter_var(trim($data['email']), FILTER_VALIDATE_EMAIL);
$password = trim($data['password']);

if (!$email) {
    Response::json(['error' => 'Invalid email format'], 400);
}

if (strlen($password) < 6) {
    Response::json(['error' => 'Password must be at least 6 characters'], 400);
}

$db = (new Database())->getConnection();

// Check for duplicates
$check = $db->prepare("SELECT id FROM users WHERE email = ?");
$check->execute([$email]);

if ($check->fetch()) {
    Response::json(['error' => 'Email already registered'], 400);
}

$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
$stmt = $db->prepare("INSERT INTO users (email, password) VALUES (?, ?)");

$stmt->execute([$email, $hashedPassword]);
Response::json(['success' => 'User registered']);
