<!DOCTYPE html>
<html lang="en">
    <?php include_once 'src/components/Header.php'; ?>
    <body class="flex flex-col items-center justify-center h-screen">
        <span class="text-4xl font-bold text-red-600"><?= $error ?> - <?= $message ?>!</span>
    </body>
</html>
