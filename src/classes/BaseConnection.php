<?php
abstract class BaseConnection
{
    protected PDO $conn;
    protected function __construct()
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
        $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }
}
