<?php
$id = $_POST['id'];
$name = $_POST['name'];
if ($todos->check_name($name)) {
    $_SESSION['error'] = 'already_exists';
    redirect('/');
    exit(1);
}
if (strlen($name) > $constants['MAX_LENGTH']) {
    $_SESSION['error'] = 'name_too_long';
    redirect('/');
    exit(1);
}
$description = $_POST['description'] ?? '';
if (strlen($description) > $constants['MAX_LENGTH'] * 4) {
    $_SESSION['error'] = 'description_too_long';
    redirect('/');
    exit(1);
}
$is_done = isset($_POST['is_done']);
$todos->set($name, $description, $is_done, $users->get_id($email), $id);
redirect('/');
