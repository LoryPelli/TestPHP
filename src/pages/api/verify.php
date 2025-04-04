<?php
session_start();
require_once 'src/utils/redirect.php';
$email = $_SESSION['email'];
$password = $_SESSION['password'];
$code = $_POST['digit'];
$userCode = implode('', $code);
$serverCode = $_SESSION['code'];
if ($userCode == $serverCode) {
    require_once 'src/classes/UserTable.php';
    $users = new UserTable();
    $users->new($email, $password);
    redirect('/');
    exit(1);
}
session_destroy();
redirect('/verify?error=wrong_code');
