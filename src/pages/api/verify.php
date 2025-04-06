<?php
session_start();
if (
    !isset($_SESSION['email']) ||
    !isset($_SESSION['password']) ||
    !isset($_SESSION['username'])
) {
    redirect('/verify?error=expired', 308);
    exit(1);
}
$email = $_SESSION['email'];
$password = $_SESSION['password'];
$username = $_SESSION['username'];
$code = $_POST['digit'];
$userCode = implode('', $code);
$serverCode = $_SESSION['code'];
if ($userCode != $serverCode) {
    redirect('/verify?error=wrong_code', 308);
    exit(1);
}
require_once 'src/classes/UserTable.php';
$users = new UserTable();
$users->new($email, $password, $username);
session_destroy();
redirect('/login');
