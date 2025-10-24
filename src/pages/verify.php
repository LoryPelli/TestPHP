<?php
$messages = require_once sprintf('%s/src/enums/AppError.php', $root);
$error = $_SESSION['error'] ?? '';
?>
<form method="POST" class="flex flex-col justify-center items-center gap-y-1 h-screen" action="/api/verify">
    <?php if (isset($messages[$error])): ?>
        <?php include_once sprintf('%s/src/components/Error.php', $root); ?>
    <?php endif; ?>
    <span class="font-bold text-xl">A verification code has been sent to your email!</span>
    <div class="flex gap-x-1">
        <?php foreach (range(0, 5) as $i): ?>
            <input name="digit[]" autocomplete="off" type="number" min="0" max="9" <?= $i ==
            0
                ? 'autofocus'
                : '' ?> required
                class="disabled:bg-gray-200 p-1 border-2 rounded-md w-12 text-center disabled:cursor-not-allowed" />
        <?php endforeach; ?>
    </div>
    <button type="submit" class="p-1 border-2 rounded-md cursor-pointer">Verify!</button>
    <script src="/input.min.js" defer></script>
</form>