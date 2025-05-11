<?php $isLogged = $email && $password && $users->check_email($email); ?>
<nav class="flex justify-between p-2">
    <a href="/">
        <button class="p-1 border-2 rounded-md cursor-pointer">Home!</button>
    </a>
    <div class="flex items-center gap-x-1 p-3 border-2 rounded-md">
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
    <div class="flex flex-col justify-center items-center h-screen">
        <span class="font-bold text-6xl italic">Login to see the rest of the page!</span>
    </div>
<?php else: ?>
    <div class="grid px-2">
        <button class="p-1 border-2 rounded-md cursor-pointer" onclick="openDialog()">Add!</button>
    </div>
    <dialog class="backdrop:backdrop-blur-sm">
        <div class="fixed inset-0 flex flex-col justify-center items-center h-screen">
            <div data-dialog class="flex flex-col items-center shadow-2xl p-5 rounded-md">
                <button class="p-1 border-2 rounded-md cursor-pointer" onclick="closeDialog()">
                    <?php include_once 'svg/close.php'; ?>
                </button>
                <form method="POST" class="flex flex-col justify-center items-center gap-y-1">
                    <span>Done:</span>
                    <input name="is_done" type="checkbox" class="after:flex after:justify-center bg-red-600 checked:bg-blue-600 border-2 rounded-md focus:outline-none size-7 after:text-white after:content-['✕'] checked:after:content-['✓'] appearance-none cursor-pointer" />
                    <span>Name:</span>
                    <input name="name" autocomplete="off" type="text" required class="p-1 border-2 rounded-md w-60" />
                    <span>Description:</span>
                    <input name="description" autocomplete="off" type="text" class="p-1 border-2 rounded-md w-60" />
                    <button type="submit" class="p-1 border-2 rounded-md cursor-pointer">Create!</button>
                </form>                
            </div>
        </div>
    </dialog>
<?php endif; ?>
<script src="/public/dialog.min.js"></script>