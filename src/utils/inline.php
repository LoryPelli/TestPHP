<?php
function inline(string $file): string
{
    global $root;
    return preg_replace(
        '/\s+/',
        ' ',
        file_get_contents(sprintf('%s/%s', $root, $file)),
    );
}
