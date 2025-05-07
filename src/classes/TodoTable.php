<?php
require_once 'src/classes/BaseTable.php';
$constants = require_once 'src/utils/constants.php';
class TodoTable extends BaseTable
{
    public function __construct()
    {
        global $constants;
        parent::__construct();
        $this->conn->query(
            sprintf(
                "CREATE TABLE IF NOT EXISTS todos (
            id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
            name VARCHAR(%d) NOT NULL,
            description VARCHAR(%d) NOT NULL,
            user_id UUID,
            is_done BOOLEAN,
            FOREIGN KEY (user_id) REFERENCES users(id)
            )",
                $constants['MAX_LENGTH'],
                $constants['MAX_LENGTH'] * 4
            )
        );
    }
}
