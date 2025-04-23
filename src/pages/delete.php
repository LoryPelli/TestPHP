<?php
$skip = isset($_GET['skip-confirmation']);
if (!$skip) {
    require_once 'src/enums/Type.php';
    $type = Type::Delete;
    include_once 'src/components/Confirmation.php';
    exit(0);
}
$error = $_SESSION['error'] ?? '';
?>
<form method="POST" class="flex flex-col items-center justify-center h-screen gap-y-1" action="/api/delete">
    <?php if (isset($messages[$error])): ?>
        <?php include_once 'src/components/Error.php'; ?>
    <?php endif; ?>
    <span>Type your password to delete your account:</span>
    <input name="password" autocomplete="off" type="password" required class="p-1 border-2 rounded-md w-60" />
    <button type="submit" class="p-1 border-2 rounded-md cursor-pointer">Delete!</button>
    <span>Forgot password? No problem, you can <a href="/reset" class="text-blue-600 hover:underline">reset here</a>!</span>
</form>