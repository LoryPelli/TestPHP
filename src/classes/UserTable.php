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
            id SERIAL PRIMARY KEY,
            email TEXT NOT NULL UNIQUE,
            password TEXT NOT NULL
        );"
        );
    }
    public function new(string $email, string $password)
    {
        $res = pg_query_params(
            $this->conn,
            "INSERT INTO users (email, password) VALUES ($1, $2);",
            [$email, $password]
        );
        if (!$res) {
            return false;
        }
        return true;
    }
}
?>
