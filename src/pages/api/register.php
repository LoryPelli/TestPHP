<?php
session_start();
require_once 'src/classes/UserTable.php';
$email = $_POST['email'];
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    redirect('/register?error=invalid_email');
    exit(1);
}
$password = $_POST['password'];
$repeat_password = $_POST['repeat_password'];
if ($password != $repeat_password) {
    redirect('/register?error=passwords_not_match');
    exit(1);
}
$hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
$username = $_POST['username'];
$users = new UserTable();
if ($users->check_email($email)) {
    redirect('/register?error=already_exists');
    exit(1);
}
$code = mt_rand(100000, 999999);
$_SESSION['email'] = $email;
$_SESSION['password'] = $hash;
$_SESSION['username'] = $username;
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
