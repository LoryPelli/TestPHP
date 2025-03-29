<?php
$title = 'Login'; ?>

<form method="POST" class="flex flex-col gap-y-1 items-center justify-center h-screen" action="/api/login">
    <span>Username:</span>
    <input name="username" autocomplete="off" class="p-1 border-2 border-black rounded-md" />
    <span>Password:</span>
    <input name="password" autocomplete="off" type="password" class="p-1 border-2 border-black rounded-md" />
    <button type="submit" class="border-2 border-black rounded-md p-1">Login</button>
</form>
