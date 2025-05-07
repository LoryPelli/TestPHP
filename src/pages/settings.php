<?php
$messages = require_once 'src/enums/UserError.php';
$error = $_SESSION['error'] ?? '';
?>
<form method="POST" class="flex flex-col items-center justify-center h-screen gap-y-1" action="/api/settings">
    <?php if (isset($messages[$error])): ?>
        <?php include_once 'src/components/Error.php'; ?>
    <?php endif; ?>
    <span>Username:</span>
    <input name="username" autocomplete="off" maxlength="<?= $constants[
        'MAX_LENGTH'
    ] ?>" value="<?= htmlspecialchars(
    $users->get_username($email)
) ?>" class="p-1 border-2 rounded-md" />
    <span>Avatar URL</span>
    <input name="avatar" autocomplete="off" type="url" value="<?= htmlspecialchars(
        $users->get_avatar($email)
    ) ?>" class="p-1 border-2 rounded-md" />
    <span>Do you want to reset your password? You can <a href="/reset" class="text-blue-600 hover:underline">do it here</a>!</span>
    <details>
        <summary class="text-center cursor-pointer">Dangerous settings!</summary>
        <span>Do you want to delete your account? Just <a href="/delete?skip-confirmation" class="text-blue-600 hover:underline">click here</a>!</span>
    </details>
    <button type="submit" class="p-1 border-2 rounded-md cursor-pointer">Save!</button>
</form>