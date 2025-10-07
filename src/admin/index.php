<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once sprintf('%s/vendor/autoload.php', $root);
require_once sprintf('%s/src/classes/AdminView.php', $root);
require_once sprintf('%s/src/utils/buffer.php', $root);
Dotenv\Dotenv::createImmutable($root)->load();
$admin = new AdminView();
ob_start(buffer(...));
echo 'Hello, World!';
ob_end_flush();
