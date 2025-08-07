<?php
function buffer(string $buffer): string
{
    global $root;
    $html = require_once sprintf('%s/src/minify/index.php', $root);
    $html->doRemoveOmittedQuotes(false);
    $html->doRemoveOmittedHtmlTags(false);
    $html->doSortCssClassNames(false);
    return $html->minify($buffer);
}
