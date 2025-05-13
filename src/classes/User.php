<?php
final class User
{
    private string $email;
    private string $password;
    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }
    public function get_email(): string
    {
        return $this->email;
    }
    public function get_password(): string
    {
        return $this->password;
    }
}
