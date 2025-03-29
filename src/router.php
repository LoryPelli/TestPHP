<?php
$file = trim(parse_url($_SERVER['REQUEST_URI'])['path'], '/') ?: 'index';
$path = sprintf('src/pages/%s.php', $file);
if (!file_exists($path)) {
    $file = '404';
    $path = 'src/pages/404.php';
}
$config = require_once 'src/config/index.php';
$page = $config[$file];
$title = $page['title'];
$description = $page['description'];
include_once 'src/components/Header.php';
?>

<body>
    <?php require_once $path; ?>
</body>
