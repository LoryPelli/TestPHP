<?php
session_name('session');
session_start();
require_once 'vendor/autoload.php';
require_once 'src/enums/ServerError.php';
require_once 'src/utils/redirect.php';
require_once 'src/classes/UserTable.php';
require_once 'src/classes/TodoTable.php';
require_once 'src/classes/Constants.php';
$cookies = require_once 'src/cookies/index.php';
Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'])->load();
$resend = Resend::client($_ENV['APIKEY']);
$url_path = parse_url($_SERVER['REQUEST_URI'])['path'];
$file = trim($url_path, '/') ?: 'index';
if (!str_ends_with($file, '.php')) {
    $publicFile = sprintf('%s/public/%s', $_SERVER['DOCUMENT_ROOT'], $file);
    if (file_exists($publicFile)) {
        header(
            sprintf(
                'Content-Type: %s',
                horstoeko\mimedb\MimeDb::singleton()->findFirstMimeTypeByExtension(
                    pathinfo($publicFile, PATHINFO_EXTENSION),
                ),
            ),
        );
        readfile($publicFile);
        exit(0);
    }
}
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
$hasExt = pathinfo($file, PATHINFO_EXTENSION) != '';
if (!$isAPI && !$hasExt) {
    $config = require_once 'src/config/index.php';
    $page = $config[$file];
    $title = $page['title'];
    $description = $page['description'];
} else {
    require_once $path;
    exit(0);
}
require_once 'src/utils/buffer.php';
$isLogged = $email && $password && $users->check_email($email);
ob_start(buffer(...));
?>
<?php if (!$hasExt): ?>
    <!DOCTYPE html>
    <html lang="en">
        <?php include_once 'src/components/Header.php'; ?>
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
                            '/user.png' ?>" loading="lazy" class="rounded-full size-10" />
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
            <?php require_once $path; ?>
        </body>
    </html>
    <?php unset($_SESSION['error']); ?>
<?php else: ?>
    <?php require_once $path; ?>
<?php endif; ?>
<?php ob_end_flush(); ?>
