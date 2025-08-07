<?php
require_once sprintf('%s/src/utils/buffer.php', $root);
ob_start(buffer(...));
?>
<!DOCTYPE html>
<html lang="en">
    <?php include_once sprintf('%s/src/components/Header.php', $root); ?>
    <body class="flex flex-col justify-center items-center h-screen">
        <span class="font-bold text-red-600 text-4xl"><?= $error ?> - <?= $message ?>!</span>
    </body>
</html>
<?php ob_end_flush(); ?>
