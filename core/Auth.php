<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Auth
{
    private static $secret = 'your_super_secret_key';

    public static function createToken($userId)
    {
        $payload = [
            'sub' => $userId,
            'iat' => time(),
            'exp' => time() + (60 * 60 * 24) // 1 day expiry
        ];
        return JWT::encode($payload, self::$secret, 'HS256');
    }

    public static function verifyToken($token)
    {
        try {
            return JWT::decode($token, new Key(self::$secret, 'HS256'));
        } catch (Exception $e) {
            return null;
        }
    }
}
