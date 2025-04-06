<?php
session_start();
require_once 'src/classes/UserTable.php';
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$users = new UserTable();
if ($users->check_email($email)) {
    redirect('/register?error=already_exists');
    exit(1);
}
$code = mt_rand(100000, 999999);
$_SESSION['email'] = $email;
$_SESSION['password'] = $password;
$_SESSION['code'] = $code;
require_once 'vendor/autoload.php';
Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'])->load();
$resend = Resend::client($_ENV['APIKEY']);
$resend->emails->send([
    'from' => $_ENV['EMAIL'],
    'to' => $email,
    'subject' => 'Verification Code',
    'text' => sprintf('Your verification code is: %s', $code),
]);
redirect('/verify', 308);
