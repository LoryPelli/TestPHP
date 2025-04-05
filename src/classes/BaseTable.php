<?php
require_once 'vendor/autoload.php';
Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'])->load();
abstract class BaseTable
{
    protected $conn;
    public function __construct()
    {
        $this->conn = new PDO(
            sprintf(
                'pgsql:host=%s;dbname=%s',
                $_ENV['PGHOST'],
                $_ENV['PGDATABASE']
            ),
            $_ENV['PGUSER'],
            $_ENV['PGPASSWORD']
        );
    }
}
