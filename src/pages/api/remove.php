<?php
$name = $_POST['name'];
$todos->delete($users->get_id($email), $name);
redirect('/');
