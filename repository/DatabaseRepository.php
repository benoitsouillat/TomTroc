<?php

class DatabaseRepository
{
    private static $instance;
    private $db;

    private function __construct()
    {
        $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASSWORD);
    }

    public static function getInstance(): DatabaseRepository
    {
        if (!self::$instance) {
            self::$instance = new DatabaseRepository();
        }
        return self::$instance;
    }
    public function getConnection(): PDO
    {
        return $this->db;
    }
}
