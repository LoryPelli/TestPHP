<?php
session_name('session');
session_start();
$root = $_SERVER['DOCUMENT_ROOT'];
require_once sprintf('%s/vendor/autoload.php', $root);
require_once sprintf('%s/src/enums/ServerError.php', $root);
require_once sprintf('%s/src/utils/redirect.php', $root);
require_once sprintf('%s/src/classes/UserTable.php', $root);
require_once sprintf('%s/src/classes/TodoTable.php', $root);
require_once sprintf('%s/src/classes/Constants.php', $root);
$cookies = require_once sprintf('%s/src/cookies/index.php', $root);
Dotenv\Dotenv::createImmutable($root)->load();
$resend = Resend::client($_ENV['APIKEY']);
$url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$file = trim($url_path, '/') ?: 'index';
$email = $cookies->get('email');
$password = $cookies->get('password');
$users = new UserTable();
$todos = new TodoTable();
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
    ($file == 'verify' || str_starts_with($file, 'new/')) &&
    $_SERVER['REQUEST_METHOD'] != 'POST'
) {
    redirect('/');
    exit(1);
}
$isAPI = str_starts_with($file, 'api/');
$is_valid_todo = Ramsey\Uuid\Uuid::isValid($file) && $todos->has($file);
if ($is_valid_todo) {
    $file = 'index';
}
$path = sprintf('src/pages/%s.php', $file);
$exists = is_file(sprintf('%s/%s', $root, $path));
if ($isAPI && $_SERVER['REQUEST_METHOD'] != 'POST') {
    ServerError::METHOD_NOT_ALLOWED->send();
    exit(1);
}
if (!$exists && !$is_valid_todo) {
    ServerError::NOT_FOUND->send();
    exit(1);
}
$hasExt = pathinfo($file, PATHINFO_EXTENSION) != '';
if (!$isAPI && !$hasExt) {
    $config = require_once sprintf('%s/src/config/index.php', $root);
    $page = $config[$file];
    $title = $page['title'];
    $description = $page['description'];
} else {
    require_once sprintf('%s/%s', $root, $path);
    exit(0);
}
require_once sprintf('%s/src/utils/buffer.php', $root);
$isLogged = $email && $password && $users->check_email($email);
ob_start(buffer(...));
?>
<?php if (!$hasExt): ?>
    <!DOCTYPE html>
    <html lang="en">
        <?php include_once sprintf('%s/src/components/Header.php', $root); ?>
        <body class="flex flex-col h-screen">
            <nav class="flex justify-between p-2">
                <a href="/">
                    <button class="p-1 border-2 rounded-md cursor-pointer">Home!</button>
                </a>
                <div class="flex items-center gap-x-1 p-3 border-2 rounded-md">
                    <?php if (!$isLogged): ?>
                        <a href="/login">
                            <button class="p-1 border-2 rounded-md cursor-pointer">Login!</button>
                        </a>
                        <a href="/register">
                            <button class="p-1 border-2 rounded-md cursor-pointer">Register!</button>
                        </a>
                    <?php else: ?>
                        <img src="<?= htmlspecialchars(
                            $users->get_avatar($email),
                        ) ?:
                            '/user.png' ?>" loading="lazy" decoding="async" class="rounded-full size-10" />
                        <span><?= htmlspecialchars(
                            $users->get_username($email),
                        ) ?></span>
                        <a href="/settings">
                            <button class="p-1 border-2 rounded-md cursor-pointer">Settings!</button>
                        </a>
                        <a href="/logout">
                            <button class="p-1 border-2 rounded-md cursor-pointer">Logout!</button>
                        </a>
                        <script src="/error.min.js" defer></script>
                    <?php endif; ?>
                </div>
            </nav>
            <?php require_once sprintf('%s/%s', $root, $path); ?>
        </body>
    </html>
    <?php unset($_SESSION['error']); ?>
<?php else: ?>
    <?php require_once sprintf('%s/%s', $root, $path); ?>
<?php endif; ?>
<?php ob_end_flush(); ?>
