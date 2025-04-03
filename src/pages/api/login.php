<?php
require_once 'src/classes/UserTable.php';
$email = $_POST['email'];
$password = $_POST['password'];
$users = new UserTable();
if (!$users->check_email($email)) {
    header('Location: /login?error=not_found');
    exit(1);
}
if (!$users->check($email, $password)) {
    header('Location: /login?error=incorrect_password');
    exit(1);
}
header('Location: /');
