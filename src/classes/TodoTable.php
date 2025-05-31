<?php
require_once 'src/classes/BaseTable.php';
require_once 'src/classes/Todo.php';
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
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
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
    public function get_id(string $user_id, string $name): string
    {
        $res = $this->conn->prepare(
            'SELECT id FROM todos WHERE user_id = ? AND name = ?'
        );
        $res->bindParam(1, $user_id);
        $res->bindParam(2, $name);
        $res->execute();
        $row = $res->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['id'] : '';
    }
    /**
     * @return Todo[]
     */
    public function get_all(string $user_id): array
    {
        $res = $this->conn->prepare('SELECT * FROM todos WHERE user_id = ?');
        $res->bindParam(1, $user_id);
        $res->execute();
        /**
         * @var Todo[]
         */
        $arr = [];
        $row = $res->fetchAll(PDO::FETCH_ASSOC);
        if ($row) {
            foreach ($row as $r) {
                $arr[] = new Todo($r['name'], $r['description'], $r['is_done']);
            }
        }
        return $arr;
    }
    public function set(
        string $name,
        string $description,
        bool $is_done,
        string $user_id,
        string $id
    ): void {
        $res = $this->conn->prepare(
            'UPDATE todos SET name = ?, description = ?, is_done = ? WHERE user_id = ? AND id = ?'
        );
        $res->bindParam(1, $name);
        $res->bindParam(2, $description);
        $res->bindParam(3, $is_done, PDO::PARAM_BOOL);
        $res->bindParam(4, $user_id);
        $res->bindParam(5, $id);
        $res->execute();
    }
    public function delete(string $user_id, string $name): void
    {
        $res = $this->conn->prepare(
            'DELETE FROM todos WHERE user_id = ? AND name = ?'
        );
        $res->bindParam(1, $user_id);
        $res->bindParam(2, $name);
        $res->execute();
    }
}
