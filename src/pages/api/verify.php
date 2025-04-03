<?php
session_start();
$email = $_SESSION['email'];
$password = $_SESSION['password'];
$code = $_POST['digit'];
$userCode = implode('', $code);
$serverCode = $_SESSION['code'];
if ($userCode == $serverCode) {
    require_once 'src/classes/UserTable.php';
    $users = new UserTable();
    $users->new($email, $password);
    header('Location: /');
    exit(1);
}
session_destroy();
header('Location /verify?error=wrong_code');
