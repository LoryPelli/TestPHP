<?php
function redirect(string $url)
{
    header(sprintf('Location: %s', $url));
}
