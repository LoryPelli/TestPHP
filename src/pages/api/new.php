<?php
session_start();
$email = $_SESSION['email'] ?? '';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    redirect('/new?error=invalid_email', 308);
    exit(1);
}
$password = $_POST['password'];
$repeat_password = $_POST['repeat_password'];
if ($password != $repeat_password) {
    redirect('/new?error=passwords_not_match', 308);
    exit(1);
}
$hash = password_hash($password, PASSWORD_BCRYPT);
$users->set_password($email, $hash);
session_destroy();
redirect('/');
