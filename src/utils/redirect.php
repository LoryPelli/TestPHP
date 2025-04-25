<?php
function redirect(string $url, int $code = 0): void
{
    header(sprintf('Location: %s', $url), response_code: $code);
}
