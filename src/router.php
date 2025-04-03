<?php
require_once 'src/enums/ServerError.php';
$file = trim(parse_url($_SERVER['REQUEST_URI'])['path'], '/') ?: 'index';
$isAPI = str_starts_with($file, 'api');
if (!$isAPI) {
    $config = require_once 'src/config/index.php';
    $page = $config[$file];
    $title = $page['title'];
    $description = $page['description'];
}
$path = sprintf('src/pages/%s.php', $file);
$exists = file_exists($path);
$content = require_once $path;
include_once 'src/components/Header.php';
if ($isAPI && $_SERVER['REQUEST_METHOD'] != 'POST') {
    ServerError::METHOD_NOT_ALLOWED->send();
    exit(1);
} else {
    $content;
    exit(0);
}
if (!$exists) {
    ServerError::NOT_FOUND->send();
    exit(1);
}
?>

<body class="flex flex-col items-center justify-center h-screen">
    <?php $content; ?>
</body>
