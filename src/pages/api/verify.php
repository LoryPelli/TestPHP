<?php
session_start();
$email = $_SESSION['email'] ?? '';
$type = $_SESSION['type'] ?? 'register';
if ($type == 'register') {
    $password = $_SESSION['password'] ?? '';
    $username = $_SESSION['username'] ?? '';
}
if (!$email || ($type == 'register' && (!$password || !$username))) {
    redirect('/verify?error=expired', 308);
    exit(1);
}
$code = $_POST['digit'];
$userCode = implode('', $code);
$serverCode = $_SESSION['code'] ?? '';
if ($userCode != $serverCode) {
    redirect('/verify?error=wrong_code', 308);
    exit(1);
}
switch ($type) {
    case 'register':
        $users->new($email, $password, $username);
        session_destroy();
        redirect('/login');
        break;
    case 'reset':
        redirect('/new', 308);
        break;
}
