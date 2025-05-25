<?php
require_once 'src/utils/inline.php';
header('Content-Type: application/javascript');
?>
const show = '<?= inline('svg/show.php') ?>';
const hide = '<?= inline('svg/hide.php') ?>';
const capslock = '<?= inline('svg/capslock.php') ?>';
const disabledcapslock = '<?= inline('svg/disabledcapslock.php') ?>';
