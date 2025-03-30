<?php
require_once 'vendor/autoload.php';
Dotenv\Dotenv::createImmutable(__DIR__)->load();
$conn = pg_connect(
    sprintf(
        'host=%s dbname=%s user=%s password=%s',
        $_ENV['PGHOST'],
        $_ENV['PGDATABASE'],
        $_ENV['PGUSER'],
        $_ENV['PGPASSWORD']
    )
);
?>
