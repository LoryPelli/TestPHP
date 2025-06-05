<?php
$email = $_SESSION['email'] ?? '';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = 'invalid_email';
    redirect('/new/password', 308);
    exit(1);
}
$password = $_POST['password'];
$repeat_password = $_POST['repeat_password'];
if ($password != $repeat_password) {
    $_SESSION['error'] = 'passwords_not_match';
    redirect('/new/password', 308);
    exit(1);
}
$hash = password_hash($password, PASSWORD_BCRYPT);
$users->set_password($email, $hash);
session_destroy();
redirect('/');
