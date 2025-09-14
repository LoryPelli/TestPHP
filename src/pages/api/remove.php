<?php
$is_post = isset($_POST['name']);
$name = $_POST['name'] ?? $_SESSION['name'];
if ($is_post) {
    $_SESSION['name'] = $name;
    redirect('/remove', 307);
    exit(0);
}
$todos->delete($users->get_id($email), $name);
session_destroy();
redirect('/');
