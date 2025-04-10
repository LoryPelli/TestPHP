<?php
require_once 'src/enums/ServerError.php';
require_once 'src/cookies/index.php';
require_once 'src/utils/redirect.php';
$url_path = parse_url($_SERVER['REQUEST_URI'])['path'];
$file = trim($url_path, '/') ?: 'index';
if (str_starts_with($file, 'assets')) {
    return false;
}
$email = $cookies->get('email');
$password = $cookies->get('password');
if (
    in_array($file, ['index', 'settings', 'logout']) &&
    (!$email || !$password)
) {
    redirect('/login');
    exit(1);
}
if ($file == 'verify' && $_SERVER['REQUEST_METHOD'] != 'POST') {
    redirect('/');
    exit(1);
}
$isAPI = str_starts_with($file, 'api');
$path = sprintf('src/pages/%s.php', $file);
$exists = file_exists($path);
if ($isAPI && $_SERVER['REQUEST_METHOD'] != 'POST') {
    ServerError::METHOD_NOT_ALLOWED->send();
    exit(1);
}
if (!$exists) {
    ServerError::NOT_FOUND->send();
    exit(1);
}
if (!$isAPI) {
    $config = require_once 'src/config/index.php';
    $page = $config[$file];
    $title = $page['title'];
    $description = $page['description'];
} else {
    require_once $path;
    exit(0);
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once 'src/components/Header.php'; ?>

<body class="flex flex-col h-screen">
    <?php require_once $path; ?>
</body>

</html>