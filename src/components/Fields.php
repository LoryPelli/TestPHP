<?php
require_once 'src/enums/Type.php';
$isLogin = $type == Type::Login;
?>
<span>Email:</span>
<input name="email" autocomplete="off" type="email" required class="p-1 border-2 rounded-md w-60" />
<span>Password:</span>
<?php include_once 'src/components/Toggle.php'; ?>
<?php if (!$isLogin): ?>
    <span>Repeat Password:</span>
    <?php include_once 'src/components/Toggle.php'; ?>
    <span>Username:</span>
    <input name="username" autocomplete="off" required class="p-1 border-2 rounded-md w-60" />
<?php endif; ?>
<script>
    const show = `<?= file_get_contents('svg/show.php') ?>`;
    const hide = `<?= file_get_contents('svg/hide.php') ?>`;
</script>
<script src="/assets/toggle.js"></script>
