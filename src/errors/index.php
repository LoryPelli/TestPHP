<?php
ob_start(function ($buffer): string {
    $html = require_once 'src/minify/index.php';
    $html->doRemoveOmittedQuotes(false);
    $html->doSortCssClassNames(false);
    return $html->minify($buffer);
}); ?>
<!DOCTYPE html>
<html lang="en">
<?php include_once 'src/components/Header.php'; ?>

<body class="flex flex-col justify-center items-center h-screen">
    <span class="font-bold text-red-600 text-4xl"><?= $error ?> - <?= $message ?>!</span>
</body>

</html>
<?php ob_end_flush(); ?>
