<?php
require_once 'src/classes/UserTable.php';
$email = $_POST['email'];
$users = new UserTable();
echo $users->check($email);
if (!$users->check($email)) {
    header('Location: /login?error=not_found');
    exit(1);
}
?>
