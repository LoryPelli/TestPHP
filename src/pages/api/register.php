<?php
$email = $_POST['email'];
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = 'invalid_email';
    redirect('/register');
    exit(1);
}
if ($users->check_email($email)) {
    $_SESSION['error'] = 'already_exists';
    redirect('/register');
    exit(1);
}
$password = $_POST['password'];
$repeat_password = $_POST['repeat_password'];
if ($password != $repeat_password) {
    $_SESSION['error'] = 'passwords_not_match';
    redirect('/register');
    exit(1);
}
$hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
$username = $_POST['username'];
if (strlen($username) > $constants['USERNAME_MAX_LENGTH']) {
    $_SESSION['error'] = 'username_too_long';
    redirect('/register');
    exit(1);
}
$code = mt_rand(100000, 999999);
$_SESSION['email'] = $email;
$_SESSION['password'] = $hash;
$_SESSION['username'] = $username;
$_SESSION['code'] = $code;
$_SESSION['type'] = 'register';
try {
    $resend->emails->send([
        'from' => $_ENV['EMAIL'],
        'to' => $email,
        'subject' => 'Verification Code',
        'text' => sprintf('Your verification code is: %s', $code),
    ]);
} catch (Exception $_) {
    $_SESSION['error'] = 'invalid_email';
    redirect('/register');
    exit(1);
}
redirect('/verify', 308);
