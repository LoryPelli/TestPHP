<?php
require_once 'src/classes/User.php';
new User($_POST['email'], $_POST['password']);
?>
