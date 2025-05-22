<?php
require_once 'src/enums/Type.php';
$isLogout = $type == Type::Logout;
$isDelete = $type == Type::Delete;
?>
<form method="POST" class="flex flex-col justify-center items-center gap-y-1 h-screen" action="<?= sprintf(
    '/api/%s',
    ($isLogout ? 'logout' : $isDelete) ? 'delete' : 'remove'
) ?>">
    <span class="font-bold text-xl">Are you sure you want to <?= ($isLogout
            ? 'logout'
            : $isDelete)
        ? 'delete your account'
        : 'remove the todo' ?>?</span>
    <div class="flex gap-x-1">
        <button type="submit" class="p-1 border-2 rounded-md cursor-pointer">Yes!</button>
        <a href="/">
            <button type="button" class="p-1 border-2 rounded-md cursor-pointer">No!</button>
        </a>
    </div>
</form>