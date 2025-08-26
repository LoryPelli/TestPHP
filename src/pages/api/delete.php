<?php
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
$users->delete($email);
session_destroy();
redirect('/api/logout', 307);
