<?php
require_once 'src/classes/BaseTable.php';
class UserTable extends BaseTable
{
    public function __construct()
    {
        parent::__construct();
        $this->conn->query(
            "CREATE TABLE IF NOT EXISTS users (
            id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
            email TEXT NOT NULL UNIQUE,
            password TEXT NOT NULL
        );"
        );
    }
    public function new(string $email, string $password)
    {
        $res = $this->conn->prepare(
            'INSERT INTO users (email, password) VALUES (?, ?)'
        );
        $res->execute([$email, $password]);
    }
    public function check(string $email, string $password): bool
    {
        $res = $this->conn->prepare(
            'SELECT password FROM users WHERE email = ?'
        );
        $res->execute([$email]);
        $row = $res->fetch(PDO::FETCH_ASSOC);
        return password_verify($password, $row['password']);
    }
    public function check_email(string $email): bool
    {
        $res = $this->conn->prepare(
            'SELECT COUNT(*) FROM users WHERE email = ?'
        );
        $res->execute([$email]);
        $row = $res->fetch(PDO::FETCH_ASSOC);
        return $row['count'] > 0;
    }
}
