<?php
require_once 'src/classes/UserTable.php';
$username = $_POST['username'];
$avatar = $_POST['avatar'];
$email = $cookies->get('email');
$users = new UserTable();
$users->set_username($email, $username);
$users->set_avatar($email, $avatar);
redirect('/');
