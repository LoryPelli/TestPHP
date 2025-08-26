<?php
$is_confirm = isset($_GET['confirm']);
$session_email = !$is_confirm ? $_SESSION['email'] : $_SESSION['old_email'];
if (!filter_var($session_email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = 'invalid_email';
    redirect('/new/email', 307);
    exit(1);
}
$email = $_POST['email'] ?? $_SESSION['email'];
$repeat_email = $_POST['repeat_email'] ?? '';
if (!$is_confirm && $email != $repeat_email) {
    $_SESSION['error'] = 'emails_not_match';
    redirect('/new/email', 307);
    exit(1);
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = 'invalid_email';
    redirect('/new/email', 307);
    exit(1);
}
if (!$is_confirm) {
    $code = mt_rand(100000, 999999);
    $_SESSION['old_email'] = $session_email;
    $_SESSION['email'] = $email;
    $_SESSION['code'] = $code;
    $_SESSION['type'] = 'change_confirm';
    try {
        $resend->emails->send([
            'from' => $_ENV['EMAIL'],
            'to' => $email,
            'subject' => 'Verification Code',
            'text' => sprintf('Your verification code is: %s', $code),
        ]);
    } catch (Exception) {
        $_SESSION['error'] = 'invalid_email';
        redirect('/new/email');
        exit(1);
    }
    redirect('/verify', 307);
    exit(0);
}
$users->set_email($session_email, $email);
session_destroy();
redirect('/api/logout', 307);
