<?php
require_once sprintf('%s//src/utils/generate_code.php', $root);
require_once sprintf('%s/src/utils/send_email.php', $root);
$is_confirm = isset($_GET['confirm']);
if (!$is_confirm) {
    $password = $_POST['password'] ?? '';
    if (!$password) {
        redirect('/delete?skip-confirmation');
        exit(0);
    }
    if (!$users->check($email, $password)) {
        $_SESSION['error'] = 'incorrect_password';
        redirect('/delete?skip-confirmation');
        exit(1);
    }
    $code = generate_code();
    $_SESSION['email'] = $email;
    $_SESSION['code'] = $code;
    $_SESSION['type'] = 'delete_confirm';
    send_email($email, $code, 'delete?skip-confirmation');
    redirect('/verify', 307);
    exit(0);
}
try {
    $users->delete($email);
    redirect('/api/logout', 307);
} catch (Exception) {
    $_SESSION['error'] = 'delete_failed';
    redirect('/delete?skip-confirmation');
    exit(1);
}
