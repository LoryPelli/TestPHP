<?php
session_start();
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
if (strlen($username) > $constants['USERNAME_MAX_LENGTH']) {
    redirect('/register?error=too_long');
    exit(1);
}
if ($users->check_email($email)) {
    redirect('/register?error=already_exists');
    exit(1);
}
$code = mt_rand(100000, 999999);
$_SESSION['email'] = $email;
$_SESSION['password'] = $hash;
$_SESSION['username'] = $username;
$_SESSION['code'] = $code;
$resend->emails->send([
    'from' => $_ENV['EMAIL'],
    'to' => $email,
    'subject' => 'Verification Code',
    'text' => sprintf('Your verification code is: %s', $code),
]);
redirect('/verify', 308);
