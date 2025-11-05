<?php
function get_fallback_avatar(): void
{
    echo file_get_contents('./fallback.png');
    exit(0);
}
$root = $_SERVER['DOCUMENT_ROOT'];
require_once sprintf('%s/vendor/autoload.php', $root);
require_once sprintf('%s/src/classes/UserTable.php', $root);
$cookies = require_once sprintf('%s/src/cookies/index.php', $root);
Dotenv\Dotenv::createImmutable($root)->load();
header('Content-Type: image/gif');
$users = new UserTable();
$email = $cookies->get('email') ?? '';
$avatar = $users->get_avatar($email) ?? get_fallback_avatar();
$c = new GuzzleHttp\Client();
try {
    $res = $c->get($avatar);
    $body = $res->getBody();
    echo $body->getContents();
} catch (Exception) {
    get_fallback_avatar();
}
