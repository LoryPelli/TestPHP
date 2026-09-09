<?php
function redirect(string $url, int $code = 302): void
{
    header(sprintf('Location: %s', $url), true, $code);
}
