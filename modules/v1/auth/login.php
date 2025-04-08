<?php

require_once __DIR__ . '/../../core/Database.php';
require_once __DIR__ . '/../../core/Response.php';
require_once __DIR__ . '/../../core/Auth.php';
require_once __DIR__ . '/../../../vendor/autoload.php'; // JWT

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['email'], $data['password'])) {
    Response::json(['error' => 'Email and password required'], 400);
}

$email = filter_var(trim($data['email']), FILTER_VALIDATE_EMAIL);
$password = $data['password'];

$db = (new Database())->getConnection();
$stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    $token = Auth::createToken($user['id']);
    Response::json(['success' => 'Login successful', 'token' => $token]);
} else {
    Response::json(['error' => 'Invalid credentials'], 401);
}
