<?php
require_once 'src/classes/UserTable.php';
$email = $_POST['email'];
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    redirect('/login?error=invalid_email');
    exit(1);
}
$password = $_POST['password'];
if (!$users->check_email($email)) {
    redirect('/login?error=not_found');
    exit(1);
}
if (!$users->check($email, $password)) {
    redirect('/login?error=incorrect_password');
    exit(1);
}
$user = $users->get($email, $password);
if ($user) {
    $cookies->set('email', $user->get_email());
    $cookies->set('password', $user->get_password());
}
redirect('/');
