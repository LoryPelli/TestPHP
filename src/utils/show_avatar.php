<?php
require_once sprintf('%s/src/utils/show_fallback_avatar.php', $root);
function show_avatar(string $avatar): void
{
    $c = new GuzzleHttp\Client();
    try {
        $res = $c->get($avatar);
        $body = $res->getBody();
        echo $body->getContents();
    } catch (Exception) {
        show_fallback_avatar();
    }
}
