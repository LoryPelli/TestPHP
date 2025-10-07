<?php
require_once sprintf('%s/src/classes/BaseConnection.php', $root);
final class AdminView extends BaseConnection
{
    public function __construct()
    {
        parent::__construct();
        $this->conn->query(
            "CREATE OR REPLACE VIEW admin AS (
                SELECT u.email, u.username, t.name, t.description, t.is_done
                FROM users AS u
                JOIN todos AS t
                ON u.id = t.id
            )",
        );
    }
}
