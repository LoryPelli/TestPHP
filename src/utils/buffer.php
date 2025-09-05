<?php
function buffer(string $buffer): string
{
    $html = new voku\helper\HtmlMin();
    $html->doRemoveOmittedQuotes(false);
    $html->doRemoveOmittedHtmlTags(false);
    $html->doSortCssClassNames(false);
    return $html->minify($buffer);
}
