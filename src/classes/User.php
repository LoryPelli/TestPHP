<?php
require_once 'src/classes/Base.php';
class User extends Base
{
    private $email;
    private $password;
    public function __construct($email, $password)
    {
        parent::__construct();
        $this->email = $email;
        $this->password = $password;
        pg_query(
            $this->conn,
            "CREATE TABLE IF NOT EXISTS users (
            id SERIAL PRIMARY KEY,
            email TEXT NOT NULL UNIQUE,
            password TEXT NOT NULL
        );"
        );
        pg_query_params(
            $this->conn,
            "INSERT INTO users (email, password) VALUES ($1, $2);",
            [$this->email, password_hash($this->password, PASSWORD_BCRYPT)]
        );
    }
}
?>
