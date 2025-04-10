<?php
require_once 'src/enums/Type.php';
$isLogin = $type == Type::Login;
?>
<span>Email:</span>
<input name="email" autocomplete="off" type="email" required class="p-1 border-2 rounded-md" />
<span>Password:</span>
<div class="flex flex-row-reverse">
    <input name="password" autocomplete="off" type="password" required class="p-1 border-2 rounded-md" />
    <button type="button" class="absolute p-1.5 cursor-pointer"></button>
</div>
<?php if (!$isLogin): ?>
    <span>Repeat Password:</span>
    <div class="flex flex-row-reverse">
        <input name="repeat_password" autocomplete="off" type="password" class="p-1 border-2 rounded-md" />
        <button type="button" class="absolute p-1.5 cursor-pointer"></button>
    </div>
    <span>Username:</span>
    <input name="username" autocomplete="off" required class="p-1 border-2 rounded-md" />
<?php endif; ?>
<script src="/assets/toggle.js"></script>
