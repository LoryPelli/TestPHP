<?php
$skip = isset($_GET['skip-confirmation']);
if (!$skip) {
    require_once 'src/enums/Type.php';
    $type = Type::Delete;
    include_once 'src/components/Confirmation.php';
    exit(0);
}
$messages = require_once 'src/enums/UserError.php';
$error = $_SESSION['error'] ?? '';
?>
<form method="POST" class="flex flex-col justify-center items-center gap-y-1 h-screen" action="/api/delete">
    <?php if (isset($messages[$error])): ?>
        <?php include_once 'src/components/Error.php'; ?>
    <?php endif; ?>
    <span>Type your password to delete your account:</span>
    <div data-pwd class="relative flex flex-row-reverse">
        <?php include_once 'src/components/CapsLock.php'; ?>
        <input name="password" autocomplete="off" type="password" required class="px-8 py-1 border-2 rounded-md w-60" />
        <?php include_once 'src/components/Toggle.php'; ?>
    </div>
    <button type="submit" class="p-1 border-2 rounded-md cursor-pointer">Delete!</button>
    <span>Forgot password? No problem, you can <a href="/reset" class="text-blue-600 hover:underline">reset here</a>!</span>
</form>
<script src="/icons.js" defer></script>
<script src="/toggle.min.js" defer></script>