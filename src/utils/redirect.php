<?php
function redirect(string $url, int $code = 0)
{
    header(sprintf('Location: %s', $url), response_code: $code);
}
