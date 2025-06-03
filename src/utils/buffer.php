<?php
function buffer(string $buffer): string
{
    $html = require_once 'src/minify/index.php';
    $html->doRemoveOmittedQuotes(false);
    $html->doSortCssClassNames(false);
    return $html->minify($buffer);
}
