<?php
require_once 'src/classes/BaseTable.php';
require_once 'src/classes/User.php';
$constants = require_once 'src/utils/constants.php';
class UserTable extends BaseTable
{
    public function __construct()
    {
        global $constants;
        parent::__construct();
        $this->conn->query(
            sprintf(
                "CREATE TABLE IF NOT EXISTS users (
            id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
            email TEXT NOT NULL UNIQUE,
            password TEXT NOT NULL,
            username VARCHAR(%d) NOT NULL,
            avatar TEXT NOT NULL DEFAULT ''
        )",
                $constants['USERNAME_MAX_LENGTH']
            )
        );
    }
    public function new(string $email, string $password, string $username): void
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
        $res = $this->conn->prepare(
            'SELECT email, password FROM users WHERE email = ?'
        );
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
    public function get_avatar(string $email): string
    {
        $res = $this->conn->prepare('SELECT avatar FROM users WHERE email = ?');
        $res->execute([$email]);
        $row = $res->fetch(PDO::FETCH_ASSOC);
        return $row['avatar'];
    }
    public function set_username(string $email, string $username): void
    {
        $res = $this->conn->prepare(
            'UPDATE users SET username = ? WHERE email = ?'
        );
        $res->execute([$username, $email]);
    }
    public function set_avatar(string $email, string $avatar): void
    {
        $res = $this->conn->prepare(
            'UPDATE users SET avatar = ? WHERE email = ?'
        );
        $res->execute([$avatar, $email]);
    }
    public function set_password(string $email, string $password): void
    {
        $res = $this->conn->prepare(
            'UPDATE users SET password = ? WHERE email = ?'
        );
        $res->execute([$password, $email]);
    }
}
