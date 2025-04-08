<?php
// CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../core/Router.php';
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/Response.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../core/Middleware.php';

$router = new Router();

// 🔐 Versioned routes: /api/v1/...
$base = '/api/v1';

// Public
$router->add('POST', "$base/register", __DIR__ . '/../modules/v1/auth/register.php');
$router->add('POST', "$base/login", __DIR__ . '/../modules/v1/auth/login.php');

// Protected
$router->add('GET', "$base/me", __DIR__ . '/../modules/v1/auth/me.php', ['Middleware', 'auth']);

$router->run();
