<?php
abstract class BaseConnection
{
    protected PDO $conn;
    public function __construct()
    {
        $this->conn = new PDO(
            sprintf(
                'pgsql:host=%s;dbname=%s',
                $_ENV['PGHOST'],
                $_ENV['PGDATABASE'],
            ),
            $_ENV['PGUSER'],
            $_ENV['PGPASSWORD'],
        );
    }
}
