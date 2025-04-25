<?php
session_name("SESSION");
session_start();
require_once 'src/enums/ServerError.php';
$cookies = require_once 'src/cookies/index.php';
require_once 'src/utils/redirect.php';
require_once 'src/classes/UserTable.php';
Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'])->load();
$resend = Resend::client($_ENV['APIKEY']);
$url_path = parse_url($_SERVER['REQUEST_URI'])['path'];
$file = trim($url_path, '/') ?: 'index';
if (str_starts_with($file, 'assets')) {
    return false;
}
$email = $cookies->get('email');
$password = $cookies->get('password');
$users = new UserTable();
if (
    in_array($file, ['login', 'register']) &&
    $email &&
    $password &&
    $users->check_email($email)
) {
    redirect('/');
    exit(1);
}
if (
    in_array($file, ['settings', 'logout', 'delete']) &&
    (!$email || !$password || !$users->check_email($email))
) {
    $cookies->remove('email');
    $cookies->remove('password');
    redirect('/');
    exit(1);
}
if (
    ($file == 'verify' || $file == 'new') &&
    $_SERVER['REQUEST_METHOD'] != 'POST'
) {
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
<?php unset($_SESSION['error']); ?>
