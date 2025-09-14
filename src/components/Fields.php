<?php
require_once sprintf('%s/src/enums/Type.php', $root);
$isLogin = $type == Type::Login;
?>
<span>Email:</span>
<input name="email" autocomplete="off" type="email" required class="p-1 border-2 rounded-md w-60" />
<span>Password:</span>
<div data-pwd class="relative flex flex-row-reverse">
    <?php include sprintf('%s/src/components/CapsLock.php', $root); ?>
    <input name="password" autocomplete="off" type="password" required class="px-8 py-1 border-2 rounded-md w-60" />
    <?php include sprintf('%s/src/components/Toggle.php', $root); ?>
</div>
<?php if (!$isLogin): ?>
    <span>Repeat Password:</span>
    <div data-pwd class="relative flex flex-row-reverse">
        <?php include sprintf('%s/src/components/CapsLock.php', $root); ?>
        <input name="repeat_password" autocomplete="off" type="password" required class="px-8 py-1 border-2 rounded-md w-60" />
        <?php include sprintf('%s/src/components/Toggle.php', $root); ?>
    </div>
    <span>Username:</span>
    <input name="username" autocomplete="off" maxlength="<?= Constants::MAX_NAME_LENGTH ?>" required class="p-1 border-2 rounded-md w-60" />
<?php endif; ?>
<?php include sprintf('%s/src/components/Icons.php', $root); ?>
<script src="/toggle.min.js" defer></script>