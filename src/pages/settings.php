<?php
require_once 'src/classes/UserTable.php';
$users = new UserTable();
?>
<form method="POST" class="flex flex-col items-center justify-center h-screen gap-y-1" action="/api/settings">
    <span>Username:</span>
    <input name="username" autocomplete="off" value="<?= $users->get_username(
        $cookies->get('email')
    ) ?>" class="p-1 border-2 rounded-md" />
    <span>Avatar URL</span>
    <input name="avatar" autocomplete="off" type="url" class="p-1 border-2 rounded-md" />
    <button type="submit" class="p-1 border-2 rounded-md cursor-pointer">Save!</button>
</form>