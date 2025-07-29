<?php
require_once 'src/utils/buffer.php';
ob_start(buffer(...));
?>
<!DOCTYPE html>
<html lang="en">
    <?php include_once 'src/components/Header.php'; ?>
    <body class="flex flex-col justify-center items-center h-screen">
        <span class="font-bold text-red-600 text-4xl"><?= $error ?> - <?= $message ?>!</span>
    </body>
</html>
<?php ob_end_flush(); ?>
