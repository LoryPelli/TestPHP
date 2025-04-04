<?php
require_once 'src/classes/UserTable.php';
require_once 'src/utils/redirect.php';
$email = $_POST['email'];
$password = $_POST['password'];
$users = new UserTable();
if (!$users->check_email($email)) {
    redirect('/login?error=not_found');
    exit(1);
}
if (!$users->check($email, $password)) {
    redirect('/login?error=incorrect_password');
    exit(1);
}
redirect('/');
