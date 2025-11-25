<?php
$messages = require_once sprintf('%s/src/enums/AppError.php', $root);
$error = $_SESSION['error'] ?? '';
?>
<form method="POST" class="flex flex-col justify-center items-center gap-y-1 h-screen" action="/api/new/password">
    <?php if (isset($messages[$error])): ?>
        <?php include_once sprintf('%s/src/components/Error.php', $root); ?>
    <?php endif; ?>
    <span>New Password:</span>
    <div data-pwd class="relative flex flex-row-reverse">
        <?php include sprintf('%s/src/components/CapsLock.php', $root); ?>
        <input name="password" autocomplete="off" type="password" required class="px-8 py-1 border-2 rounded-md w-60" />
        <?php include sprintf('%s/src/components/Toggle.php', $root); ?>
    </div>
    <span>Repeat New Password:</span>
    <div data-pwd class="relative flex flex-row-reverse">
        <?php include sprintf('%s/src/components/CapsLock.php', $root); ?>
        <input name="repeat_password" autocomplete="off" type="password" required
            class="px-8 py-1 border-2 rounded-md w-60" />
        <?php include sprintf('%s/src/components/Toggle.php', $root); ?>
    </div>
    <button type="submit" class="p-1 border-2 rounded-md cursor-pointer">Continue!</button>
</form>
<?php include_once sprintf('%s/src/components/Icons.php', $root); ?>
<script src="/toggle.min.js" defer></script>