<?php
require_once sprintf('%s/src/classes/BaseTable.php', $root);
require_once sprintf('%s/src/classes/User.php', $root);
final class UserTable extends BaseTable
{
    public function __construct()
    {
        parent::__construct();
        $this->conn->query(
            sprintf(
                "CREATE TABLE IF NOT EXISTS users (
                    id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
                    email VARCHAR(%d) UNIQUE NOT NULL,
                    password VARCHAR(%d) NOT NULL,
                    username VARCHAR(%d) NOT NULL,
                    avatar TEXT NOT NULL DEFAULT ''
                )",
                Constants::MAX_EMAIL_LENGTH,
                Constants::MAX_PASSWORD_LENGTH,
                Constants::MAX_NAME_LENGTH,
            ),
        );
    }
    public function new(string $email, string $password, string $username): void
    {
        $res = $this->conn->prepare(
            'INSERT INTO users (email, password, username) VALUES (?, ?, ?)',
        );
        $res->bindParam(1, $email);
        $res->bindParam(2, $password);
        $res->bindParam(3, $username);
        $res->execute();
    }
    public function check(string $email, string $password): bool
    {
        $res = $this->conn->prepare(
            'SELECT password FROM users WHERE email = ?',
        );
        $res->bindParam(1, $email);
        $res->execute();
        $row = $res->fetch(PDO::FETCH_ASSOC);
        return $row && password_verify($password, $row['password']);
    }
    public function check_email(string $email): bool
    {
        $res = $this->conn->prepare(
            'SELECT EXISTS(SELECT 1 FROM users WHERE email = ?)',
        );
        $res->bindParam(1, $email);
        $res->execute();
        $exists = $res->fetchColumn();
        return $exists;
    }
    public function get(string $email, string $password): ?User
    {
        $res = $this->conn->prepare(
            'SELECT email, password FROM users WHERE email = ?',
        );
        $res->bindParam(1, $email);
        $res->execute();
        $row = $res->fetch(PDO::FETCH_ASSOC);
        if ($row && password_verify($password, $row['password'])) {
            return new User($row['email'], $row['password']);
        }
        return null;
    }
    public function get_id(string $email): string
    {
        $res = $this->conn->prepare('SELECT id FROM users WHERE email = ?');
        $res->bindParam(1, $email);
        $res->execute();
        $row = $res->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['id'] : '';
    }
    public function get_username(string $email): string
    {
        $res = $this->conn->prepare(
            'SELECT username FROM users WHERE email = ?',
        );
        $res->bindParam(1, $email);
        $res->execute();
        $row = $res->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['username'] : '';
    }
    public function get_avatar(string $email): string
    {
        $res = $this->conn->prepare('SELECT avatar FROM users WHERE email = ?');
        $res->bindParam(1, $email);
        $res->execute();
        $row = $res->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['avatar'] : '';
    }
    public function set_username(string $email, string $username): void
    {
        $res = $this->conn->prepare(
            'UPDATE users SET username = ? WHERE email = ?',
        );
        $res->bindParam(1, $username);
        $res->bindParam(2, $email);
        $res->execute();
    }
    public function set_avatar(string $email, string $avatar): void
    {
        $res = $this->conn->prepare(
            'UPDATE users SET avatar = ? WHERE email = ?',
        );
        $res->bindParam(1, $avatar);
        $res->bindParam(2, $email);
        $res->execute();
    }
    public function set_password(string $email, string $password): void
    {
        $res = $this->conn->prepare(
            'UPDATE users SET password = ? WHERE email = ?',
        );
        $res->bindParam(1, $password);
        $res->bindParam(2, $email);
        $res->execute();
    }
    public function set_email(string $old_email, string $email): void
    {
        $res = $this->conn->prepare(
            'UPDATE users SET email = ? WHERE email = ?',
        );
        $res->bindParam(1, $email);
        $res->bindParam(2, $old_email);
        $res->execute();
    }
    public function delete(string $email): void
    {
        $res = $this->conn->prepare('DELETE FROM users WHERE email = ?');
        $res->bindParam(1, $email);
        $res->execute();
    }
}
