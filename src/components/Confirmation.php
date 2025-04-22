<?php
require_once 'src/enums/Type.php';
$isLogout = $type == Type::Logout;
?>
<form method="POST" class="flex flex-col items-center justify-center h-screen gap-y-1" action="<?= sprintf(
    '/api/%s',
    $isLogout ? 'logout' : 'delete'
) ?>">
    <span class="text-xl font-bold">Are you sure you want to <?= $isLogout
        ? 'logout'
        : 'delete your account' ?>?</span>
    <div class="flex gap-x-1">
        <button type="submit" class="p-1 border-2 rounded-md cursor-pointer">Yes!</button>
        <a href="/">
            <button type="button" class="p-1 border-2 rounded-md cursor-pointer">No!</button>
        </a>
    </div>
</form>