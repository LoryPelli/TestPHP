<?php
require_once 'src/classes/User.php';
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
new User($email, $password);
?>
