<?php
require_once 'src/classes/UserTable.php';
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$users = new UserTable();
if ($users->check($email)) {
    header('Location: /register?error=already_exists');
    exit(1);
}
if ($users->new($email, $password)) {
    header('Location: /login');
} else {
    header('Location: /register');
}
?>
