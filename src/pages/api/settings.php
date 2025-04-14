<?php
require_once 'src/classes/UserTable.php';
$constants = require_once 'src/utils/constants.php';
$username = $_POST['username'];
if (strlen($username) > $constants['USERNAME_MAX_LENGTH']) {
    redirect('/settings?error=too_long');
    exit(1);
}
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
