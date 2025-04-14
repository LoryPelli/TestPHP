<?php
require_once 'src/classes/UserTable.php';
$username = $_POST['username'];
$avatar = $_POST['avatar'];
if ($avatar != '' && !filter_var($avatar, FILTER_VALIDATE_URL)) {
    redirect('/settings?error=invalid_url');
    exit(1);
}
$email = $cookies->get('email');
$users = new UserTable();
$users->set_username($email, $username);
$users->set_avatar($email, $avatar);
redirect('/');
