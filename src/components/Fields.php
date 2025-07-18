<?php
require_once 'src/enums/Type.php';
$isLogin = $type == Type::Login;
?>
<span>Email:</span>
<input name="email" autocomplete="off" type="email" required class="p-1 border-2 rounded-md w-60" />
<span>Password:</span>
<div data-pwd class="relative flex flex-row-reverse">
    <?php include 'src/components/CapsLock.php'; ?>
    <input name="password" autocomplete="off" type="password" required class="px-8 py-1 border-2 rounded-md w-60" />
    <?php include 'src/components/Toggle.php'; ?>
</div>
<?php if (!$isLogin): ?>
    <span>Repeat Password:</span>
    <div data-pwd class="relative flex flex-row-reverse">
        <?php include 'src/components/CapsLock.php'; ?>
        <input name="repeat_password" autocomplete="off" type="password" required class="px-8 py-1 border-2 rounded-md w-60" />
        <?php include 'src/components/Toggle.php'; ?>
    </div>
    <span>Username:</span>
    <input name="username" autocomplete="off" maxlength="<?= Constants::MAX_NAME_LENGTH ?>" required class="p-1 border-2 rounded-md w-60" />
<?php endif; ?>
<script src="/icons.js" defer></script>
<script src="/toggle.min.js" defer></script>