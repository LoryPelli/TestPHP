<?php
function inline(string $file): string
{
    return preg_replace('/\s+/', ' ', file_get_contents($file));
}
