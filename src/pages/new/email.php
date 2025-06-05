<?php
$messages = require_once 'src/enums/UserError.php';
$error = $_SESSION['error'] ?? '';
?>
<form method="POST" class="flex flex-col justify-center items-center gap-y-1 h-screen" action="/api/new/email">
    <?php if (isset($messages[$error])): ?>
        <?php include_once 'src/components/Error.php'; ?>
    <?php endif; ?>
    <span>New Email:</span>
    <input name="email" autocomplete="off" type="email" required class="p-1 border-2 rounded-md w-60" />
    <span>Repeat New Email:</span>
    <input name="repeat_email" autocomplete="off" type="email" required class="p-1 border-2 rounded-md w-60" />
    <button type="submit" class="p-1 border-2 rounded-md cursor-pointer">Continue!</button>
</form>