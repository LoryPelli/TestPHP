<?php
require_once 'vendor/autoload.php';
$cookies = new Josantonius\Cookie\Cookie(
    '',
    time() + 86400 * 21,
    true,
    '/',
    false,
    'Strict',
    true
);
