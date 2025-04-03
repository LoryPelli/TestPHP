<?php
session_start();
require_once 'src/classes/UserTable.php';
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$users = new UserTable();
if ($users->check_email($email)) {
    header('Location: /register?error=already_exists');
    exit(1);
}
$_SESSION['email'] = $email;
$_SESSION['password'] = $password;
$_SESSION['code'] = mt_rand(100000, 999999);
header('Location: /verify');
