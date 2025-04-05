<?php
enum ServerError: int
{
    case NOT_FOUND = 404;
    case METHOD_NOT_ALLOWED = 405;
    private function message()
    {
        return match ($this) {
            self::NOT_FOUND => 'Not Found',
            self::METHOD_NOT_ALLOWED => 'Method Not Allowed',
        };
    }
    public function send()
    {
        $error = $this->value;
        $message = $this->message();
        require_once 'src/errors/index.php';
    }
}
