<?php
class Database
{
    private $pdo;

    public function __construct()
    {
        $config = include __DIR__ . '/../config/config.php';

        $dsn = "mysql:host={$config['db_host']};dbname={$config['db_name']};charset=utf8mb4";
        $this->pdo = new PDO($dsn, $config['db_user'], $config['db_pass'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }

    public function getConnection()
    {
        return $this->pdo;
    }
}
