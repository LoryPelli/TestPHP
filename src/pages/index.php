<nav class="flex justify-between p-2">
    <a href="/">
        <button class="p-1 border-2 rounded-md cursor-pointer">Home!</button>
    </a>
    <div class="flex items-center p-3 border-2 rounded-md gap-x-1">
        <?php if (!$email || !$password || !$users->check_email($email)): ?>
            <a href="/login">
                <button class="p-1 border-2 rounded-md cursor-pointer">Login!</button>
            </a>
            <a href="/register">
                <button class="p-1 border-2 rounded-md cursor-pointer">Register!</button>
            </a>
        <?php else: ?>
            <img src="<?= $users->get_avatar($email) ?:
                '/assets/user.png' ?>" class="rounded-full size-10" />
            <span><?= $users->get_username($email) ?></span>
            <a href="/settings">
                <button class="p-1 border-2 rounded-md cursor-pointer">Settings!</button>
            </a>
            <a href="/logout">
                <button class="p-1 border-2 rounded-md cursor-pointer">Logout!</button>
            </a>
        <?php endif; ?>
    </div>
</nav>