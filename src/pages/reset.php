<?php
$messages = require_once 'src/enums/UserError.php';
$error = $_SESSION['error'] ?? '';
?>
<form method="POST" class="flex flex-col items-center justify-center h-screen gap-y-1" action="/api/reset">
    <?php if (isset($messages[$error])): ?>
        <div class="p-2 font-bold text-white bg-red-500 rounded-md">
            <span><?= $messages[$error] ?>!</span>
        </div>
    <?php endif; ?>
    <span>Email:</span>
    <input name="email" autocomplete="off" type="email" required class="p-1 border-2 rounded-md w-60" />
    <button type="submit" class="p-1 border-2 rounded-md cursor-pointer">Continue!</button>
</form>