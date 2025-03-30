<?php
$file = trim(parse_url($_SERVER['REQUEST_URI'])['path'], '/') ?: 'index';
if (str_starts_with($file, 'api') && $_SERVER['REQUEST_METHOD'] != 'POST') {
    http_response_code(405);
    header('Content-Type: application/json');
    echo 'Method Not Allowed!';
    exit(1);
}
$path = sprintf('src/pages/%s.php', $file);
if (!file_exists($path)) {
    http_response_code(404);
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
