<?php
require_once 'src/classes/BaseTable.php';
final class TodoTable extends BaseTable
{
    public function __construct()
    {
        global $constants;
        parent::__construct();
        $this->conn->query(
            sprintf(
                "CREATE TABLE IF NOT EXISTS todos (
            id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
            name VARCHAR(%d) UNIQUE NOT NULL,
            description VARCHAR(%d) NOT NULL,
            user_id UUID,
            is_done BOOLEAN NOT NULL DEFAULT FALSE,
            FOREIGN KEY (user_id) REFERENCES users(id)
            )",
                $constants['MAX_LENGTH'],
                $constants['MAX_LENGTH'] * 4
            )
        );
    }
    public function new(
        string $name,
        string $description,
        bool $is_done,
        string $user_id
    ): void {
        $res = $this->conn->prepare(
            'INSERT INTO todos (name, description, is_done, user_id) VALUES (?, ?, ?, ?)'
        );
        $res->bindParam(1, $name);
        $res->bindParam(2, $description);
        $res->bindParam(3, $is_done, PDO::PARAM_BOOL);
        $res->bindParam(4, $user_id);
        $res->execute();
    }
    public function check_name(string $name): bool
    {
        $res = $this->conn->prepare(
            'SELECT COUNT(*) FROM todos WHERE name = ?'
        );
        $res->bindParam(1, $name);
        $res->execute();
        $row = $res->fetch(PDO::FETCH_ASSOC);
        return $row && $row['count'] > 0;
    }
}
