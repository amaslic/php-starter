<?php
require_once __DIR__ . '/Auth.php';
require_once __DIR__ . '/Response.php';

class Middleware {
    public static function auth() {
        $headers = getallheaders();
        $authHeader = $headers['Authorization'] ?? null;

        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            Response::json(['error' => 'Authorization token required'], 401);
        }

        $token = str_replace('Bearer ', '', $authHeader);
        $decoded = Auth::verifyToken($token);

        if (!$decoded) {
            Response::json(['error' => 'Invalid or expired token'], 401);
        }

        return $decoded->sub; // return user ID
    }
}
