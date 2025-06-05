<?php
$email = $_SESSION['email'] ?? '';
$type = $_SESSION['type'] ?? 'register';
if ($type == 'register') {
    $password = $_SESSION['password'] ?? '';
    $username = $_SESSION['username'] ?? '';
}
if (!$email || ($type == 'register' && (!$password || !$username))) {
    $_SESSION['error'] = 'expired';
    redirect('/verify', 308);
    exit(1);
}
$code = $_POST['digit'];
$user_code = implode('', $code);
$server_code = $_SESSION['code'] ?? '';
if ($user_code != $server_code) {
    $_SESSION['error'] = 'wrong_code';
    redirect('/verify', 308);
    exit(1);
}
match ($type) {
    'register' => (function () use ($email, $password, $username): void {
        global $users;
        $users->new($email, $password, $username);
        session_destroy();
        redirect('/login');
    })(),
    'reset' => redirect('/new/password', 308),
    'change' => redirect('/new/email', 308),
    'change_confirm' => redirect('/api/new/email?confirm', 308),
};
