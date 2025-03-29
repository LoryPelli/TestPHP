<?php
$file = trim(parse_url($_SERVER['REQUEST_URI'])['path'], '/');
if ($file == '') {
    $file = 'index';
}
$path = sprintf('src/pages/%s.php', $file);
if (file_exists($path)) {
    require_once $path;
} else {
    require_once 'src/pages/404.php';
}
include_once 'src/components/Header.php';
?>
