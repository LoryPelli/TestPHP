<?php
$isPOST = isset($_POST['name']);
$name = $_POST['name'] ?? $_SESSION['name'];
if ($isPOST) {
    $_SESSION['name'] = $name;
    redirect('/remove');
    exit(0);
}
$todos->delete($users->get_id($email), $name);
session_destroy();
redirect('/');
