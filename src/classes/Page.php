<?php
final class Page
{
    private string $title;
    private string $description;
    public function __construct(string $title, string $description)
    {
        $this->title = $title;
        $this->description = $description;
    }
    public function get_title(): string
    {
        return $this->title;
    }
    public function get_description(): string
    {
        return $this->description;
    }
}
