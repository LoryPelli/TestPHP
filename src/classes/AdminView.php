<?php
require_once sprintf('%s/src/classes/BaseConnection.php', $root);
require_once sprintf('%s/src/classes/Admin.php', $root);
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
                ON u.id = t.user_id
            )",
        );
    }
    /**
     * @return Admin[]
     */
    public function get_all(): array
    {
        $res = $this->conn->query('SELECT * FROM admin');
        /**
         * @var Admin[]
         */
        $arr = [];
        $row = $res->fetchAll(PDO::FETCH_ASSOC);
        if ($row) {
            foreach ($row as $r) {
                $arr[] = new Admin(
                    $r['email'],
                    $r['username'],
                    new Todo($r['name'], $r['description'], $r['is_done']),
                );
            }
        }
        return $arr;
    }
}
