<?php
require_once 'vendor/autoload.php';
Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'])->load();
abstract class BaseTable
{
    protected $conn;
    public function __construct()
    {
        $this->conn = pg_connect(
            sprintf(
                'host=%s dbname=%s user=%s password=%s',
                $_ENV['PGHOST'],
                $_ENV['PGDATABASE'],
                $_ENV['PGUSER'],
                $_ENV['PGPASSWORD']
            )
        );
    }
}
?>
