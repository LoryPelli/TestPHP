<?php
session_start();
require_once 'src/utils/redirect.php';
$email = $_SESSION['email'];
$password = $_SESSION['password'];
$code = $_POST['digit'];
$userCode = implode('', $code);
$serverCode = $_SESSION['code'];
if ($userCode != $serverCode) {
    redirect('/verify?error=wrong_code', 308);
    exit(1);
}
require_once 'src/classes/UserTable.php';
$users = new UserTable();
$users->new($email, $password);
session_destroy();
redirect('/');
