<?php
$username = $_POST['username'];
if (strlen($username) > $constants['USERNAME_MAX_LENGTH']) {
    $_SESSION['error'] = 'username_too_long';
    redirect('/settings');
    exit(1);
}
$avatar = $_POST['avatar'];
if ($avatar != '' && !filter_var($avatar, FILTER_VALIDATE_URL)) {
    $_SESSION['error'] = 'invalid_url';
    redirect('/settings?error=invalid_url');
    exit(1);
}
$users->set_username($email, $username);
$users->set_avatar($email, $avatar);
redirect('/');
