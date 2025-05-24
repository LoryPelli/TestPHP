<?php
$messages = require_once 'src/enums/UserError.php';
$error = $_SESSION['error'] ?? '';
?>
<form method="POST" class="flex flex-col justify-center items-center gap-y-1 h-screen" action="/api/new">
    <?php if (isset($messages[$error])): ?>
        <?php include_once 'src/components/Error.php'; ?>
    <?php endif; ?>
    <span>New Password:</span>
    <div data-pwd class="relative flex flex-row-reverse">
        <?php include 'src/components/CapsLock.php'; ?>
        <input name="password" autocomplete="off" type="password" required class="px-8 py-1 border-2 rounded-md w-60" />
        <?php include 'src/components/Toggle.php'; ?>
    </div>
    <span>Repeat New Password:</span>
    <div data-pwd class="relative flex flex-row-reverse">
        <?php include 'src/components/CapsLock.php'; ?>
        <input name="repeat_password" autocomplete="off" type="password" required class="px-8 py-1 border-2 rounded-md w-60" />
        <?php include 'src/components/Toggle.php'; ?>
    </div>
    <button type="submit" class="p-1 border-2 rounded-md cursor-pointer">Continue!</button>
</form>
<?php include_once 'src/components/Icons.php'; ?>
<script src="/toggle.min.js" defer></script>