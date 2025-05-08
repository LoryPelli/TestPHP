<?php $isLogged = $email && $password && !$users->check_email($email); ?>
<nav class="flex justify-between p-2">
    <a href="/">
        <button class="p-1 border-2 rounded-md cursor-pointer">Home!</button>
    </a>
    <div class="flex items-center p-3 border-2 rounded-md gap-x-1">
        <?php if (!$isLogged): ?>
            <a href="/login">
                <button class="p-1 border-2 rounded-md cursor-pointer">Login!</button>
            </a>
            <a href="/register">
                <button class="p-1 border-2 rounded-md cursor-pointer">Register!</button>
            </a>
        <?php else: ?>
            <img src="<?= htmlspecialchars($users->get_avatar($email)) ?:
                '/public/user.png' ?>" class="rounded-full size-10" />
            <span><?= htmlspecialchars($users->get_username($email)) ?></span>
            <a href="/settings">
                <button class="p-1 border-2 rounded-md cursor-pointer">Settings!</button>
            </a>
            <a href="/logout">
                <button class="p-1 border-2 rounded-md cursor-pointer">Logout!</button>
            </a>
        <?php endif; ?>
    </div>
</nav>
<?php if (!$isLogged): ?>
    <div class="flex flex-col items-center justify-center h-screen">
        <span class="text-6xl italic font-bold">Login to see the rest of the page!</span>
    </div>
<?php endif; ?>
