<?php
require_once sprintf('%s/src/enums/Type.php', $root);
$is_logout = $type == Type::Logout;
$is_delete = $type == Type::Delete;
?>
<form method="POST" class="flex flex-col justify-center items-center gap-y-1 h-screen" action="<?= sprintf(
    '/api/%s',
    $is_logout ? 'logout' : ($is_delete ? 'delete' : 'remove'),
) ?>">
    <span class="font-bold text-xl">Are you sure you want to <?= $is_logout
        ? 'logout'
        : ($is_delete
            ? 'delete your account'
            : 'remove the todo') ?>?</span>
    <div class="flex gap-x-1">
        <button type="submit" class="p-1 border-2 rounded-md cursor-pointer">Yes!</button>
        <a href="/">
            <button type="button" class="p-1 border-2 rounded-md cursor-pointer">No!</button>
        </a>
    </div>
</form>