<?php
$id = $_POST['id'] ?? '';
$name = $_POST['name'] ?? '';
if (strlen($name) > Constants::MAX_NAME_LENGTH) {
    $_SESSION['error'] = 'name_too_long';
    redirect('/');
    exit(1);
}
$description = $_POST['description'] ?? '';
if (strlen($description) > Constants::MAX_DESCRIPTION_LENGTH) {
    $_SESSION['error'] = 'description_too_long';
    redirect('/');
    exit(1);
}
$is_done = isset($_POST['is_done']);
$todos->set($name, $description, $is_done, $users->get_id($email), $id);
redirect('/');
