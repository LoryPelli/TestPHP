<?php
$messages = require_once 'src/enums/UserError.php';
$error = $_SESSION['error'] ?? '';
?>
<form method="POST" class="flex flex-col items-center justify-center h-screen gap-y-1" action="/api/new">
    <?php if (isset($messages[$error])): ?>
        <?php include_once 'src/components/Error.php'; ?>
    <?php endif; ?>
    <span>New Password:</span>
    <div class="flex flex-row-reverse">
        <input name="password" autocomplete="off" type="password" required class="p-1 pr-8 border-2 rounded-md w-60" />
        <?php include 'src/components/Toggle.php'; ?>
    </div>
    <span>Repeat New Password:</span>
    <div class="flex flex-row-reverse">
        <input name="repeat_password" autocomplete="off" type="password" required class="p-1 pr-8 border-2 rounded-md w-60" />
        <?php include 'src/components/Toggle.php'; ?>
    </div>
    <script>
        const show = `<?= file_get_contents('svg/show.php') ?>`;
        const hide = `<?= file_get_contents('svg/hide.php') ?>`;
    </script>
    <script src="/public/toggle.min.js"></script>
    <button type="submit" class="p-1 border-2 rounded-md cursor-pointer">Continue!</button>
</form>