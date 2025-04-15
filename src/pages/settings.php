<?php
$messages = require_once 'src/enums/UserError.php';
$error = $_GET['error'] ?? '';
?>
<form method="POST" class="flex flex-col items-center justify-center h-screen gap-y-1" action="/api/settings">
    <?php if (isset($messages[$error])): ?>
        <div class="p-2 font-bold text-white bg-red-500 rounded-md">
            <span><?= $messages[$error] ?>!</span>
        </div>
    <?php endif; ?>
    <span>Username:</span>
    <input name="username" autocomplete="off" maxlength="<?= $constants[
        'USERNAME_MAX_LENGTH'
    ] ?>" value="<?= $users->get_username(
    $email
) ?>" class="p-1 border-2 rounded-md" />
    <span>Avatar URL</span>
    <input name="avatar" autocomplete="off" type="url" value="<?= $users->get_avatar(
        $email
    ) ?>" class="p-1 border-2 rounded-md" />
    <button type="submit" class="p-1 border-2 rounded-md cursor-pointer">Save!</button>
</form>