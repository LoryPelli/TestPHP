<?php
$username = $_POST['username'];
if (strlen($username) > Constants::MAX_NAME_LENGTH) {
    $_SESSION['error'] = 'username_too_long';
    redirect('/settings');
    exit(1);
}
$avatar = $_POST['avatar'];
if ($avatar) {
    if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
        $_SESSION['error'] = 'invalid_url';
        redirect('/settings');
        exit(1);
    }
    $c = new GuzzleHttp\Client();
    try {
        $res = $c->get($avatar);
        $header = $res->getHeaderLine('Content-Type');
        if (!str_starts_with($header, 'image/')) {
            $_SESSION['error'] = 'invalid_image';
            redirect('/settings');
            exit(1);
        }
    } catch (Exception) {
        $_SESSION['error'] = 'invalid_image';
        redirect('/settings');
        exit(1);
    }
}
$users->set_username($email, $username);
$users->set_avatar($email, $avatar);
session_destroy();
redirect('/');
