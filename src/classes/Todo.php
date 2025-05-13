<?php
final class Todo
{
    private string $name;
    private string $description;
    private bool $is_done;
    public function __construct(
        string $name,
        string $description,
        bool $is_done
    ) {
        $this->name = $name;
        $this->description = $description;
        $this->is_done = $is_done;
    }
    public function get_name(): string
    {
        return $this->name;
    }
    public function get_description(): string
    {
        return $this->description;
    }
    public function get_is_done(): bool
    {
        return $this->is_done;
    }
}
