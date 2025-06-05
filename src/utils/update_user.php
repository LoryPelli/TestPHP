<?php
function update_user(string $action): void
{
    global $users, $resend;
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'invalid_email';
        redirect(sprintf('/%s', $action));
        exit(1);
    }
    if (!$users->check_email($email)) {
        $_SESSION['error'] = 'not_found';
        redirect(sprintf('/%s', $action));
        exit(1);
    }
    $code = mt_rand(100000, 999999);
    $_SESSION['email'] = $email;
    $_SESSION['code'] = $code;
    $_SESSION['type'] = $action;
    try {
        $resend->emails->send([
            'from' => $_ENV['EMAIL'],
            'to' => $email,
            'subject' => 'Verification Code',
            'text' => sprintf('Your verification code is: %s', $code),
        ]);
    } catch (Exception) {
        $_SESSION['error'] = 'invalid_email';
        redirect(sprintf('/%s', $action));
        exit(1);
    }
    redirect('/verify', 308);
}
