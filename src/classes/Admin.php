<?php
require_once sprintf('%s/src/classes/Todo.php', $root);
final class Admin
{
    private string $email;
    private string $username;
    private Todo $todo;
    public function __construct(string $email, string $username, Todo $todo)
    {
        $this->email = $email;
        $this->username = $username;
        $this->todo = $todo;
    }
    public function get_email(): string
    {
        return $this->email;
    }
    public function get_username(): string
    {
        return $this->username;
    }
    public function get_todo(): Todo
    {
        return $this->todo;
    }
}
