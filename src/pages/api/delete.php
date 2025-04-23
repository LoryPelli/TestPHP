<?php
$password = $_POST['password'] ?? '';
if (!$password) {
    redirect('/delete?skip-confirmation');
    exit(0);
}
