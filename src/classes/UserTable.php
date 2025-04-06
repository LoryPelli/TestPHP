<?php
require_once 'src/classes/BaseTable.php';
require_once 'src/classes/User.php';
class UserTable extends BaseTable
{
    public function __construct()
    {
        parent::__construct();
        $this->conn->query(
            "CREATE TABLE IF NOT EXISTS users (
            id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
            email TEXT NOT NULL UNIQUE,
            password TEXT NOT NULL,
            username TEXT NOT NULL
        )"
        );
    }
    public function new(string $email, string $password, string $username)
    {
        $res = $this->conn->prepare(
            'INSERT INTO users (email, password, username) VALUES (?, ?, ?)'
        );
        $res->execute([$email, $password, $username]);
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
    public function get(string $email, string $password): User|null
    {
        $res = $this->conn->prepare('SELECT * FROM users WHERE email = ?');
        $res->execute([$email]);
        $row = $res->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password, $row['password'])) {
            return new User($row['email'], $row['password']);
        }
        return null;
    }
    public function get_username(string $email): string
    {
        $res = $this->conn->prepare(
            'SELECT username FROM users WHERE email = ?'
        );
        $res->execute([$email]);
        $row = $res->fetch(PDO::FETCH_ASSOC);
        return $row['username'];
    }
}
