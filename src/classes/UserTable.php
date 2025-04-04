<?php
require_once 'src/classes/BaseTable.php';
class UserTable extends BaseTable
{
    public function __construct()
    {
        parent::__construct();
        pg_query(
            $this->conn,
            "CREATE TABLE IF NOT EXISTS users (
            id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
            email TEXT NOT NULL UNIQUE,
            password TEXT NOT NULL
        );"
        );
    }
    public function new(string $email, string $password)
    {
        pg_query_params(
            $this->conn,
            "INSERT INTO users (email, password) VALUES ($1, $2)",
            [$email, $password]
        );
    }
    public function check(string $email, string $password): bool
    {
        $res = pg_query_params(
            $this->conn,
            "SELECT password FROM users WHERE email = $1",
            [$email]
        );
        $row = pg_fetch_assoc($res);
        return password_verify($password, $row['password']);
    }
    public function check_email(string $email): bool
    {
        $res = pg_query_params(
            $this->conn,
            "SELECT COUNT(*) FROM users WHERE email = $1",
            [$email]
        );
        $row = pg_fetch_assoc($res);
        return $row['count'] > 0;
    }
}
?>
