<?php
$messages = require_once 'src/enums/UserError.php';
$isReset = $type == Type::Reset;
$error = $_SESSION['error'] ?? '';
?>
<form method="POST" class="flex flex-col justify-center items-center gap-y-1 h-screen" action="<?= sprintf(
    '/api/%s',
    $isReset ? 'reset' : 'change'
) ?>">
    <?php if (isset($messages[$error])): ?>
        <?php include_once 'src/components/Error.php'; ?>
    <?php endif; ?>
    <span>Email:</span>
    <input name="email" autocomplete="off" type="email" required class="p-1 border-2 rounded-md w-60" />
    <button type="submit" class="p-1 border-2 rounded-md cursor-pointer">Continue!</button>
</form>