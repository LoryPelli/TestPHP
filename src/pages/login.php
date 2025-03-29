<?php
$title = 'Login'; ?>

<body>
    <form method="POST" class="flex flex-col items-center justify-center h-screen gap-y-1" action="/api/login">
        <span>Username:</span>
        <input name="username" autocomplete="off" class="p-1 border-2 border-black rounded-md" />
        <span>Password:</span>
        <input name="password" autocomplete="off" type="password" class="p-1 border-2 border-black rounded-md" />
        <button type="submit" class="p-1 border-2 border-black rounded-md">Login</button>
    </form>
</body>
