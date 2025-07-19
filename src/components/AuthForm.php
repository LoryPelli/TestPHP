<?php
require_once 'src/enums/Type.php';
$messages = require_once 'src/enums/UserError.php';
$isLogin = $type == Type::Login;
$error = $_SESSION['error'] ?? '';
?>
<form method="POST" class="flex flex-col justify-center items-center gap-y-1 h-screen" action="<?= sprintf(
    '/api/%s',
    $isLogin ? 'login' : 'register',
) ?>">
    <?php if (isset($messages[$error])): ?>
        <?php include_once 'src/components/Error.php'; ?>
    <?php endif; ?>
    <?php include_once 'src/components/Fields.php'; ?>
    <button type="submit" class="p-1 border-2 rounded-md cursor-pointer"><?= $isLogin
        ? 'Login!'
        : 'Register!' ?></button>
    <?php if (!$isLogin): ?>
        <span>Already have an account? You can <a href="/login" class="text-blue-600 hover:underline">login here</a>!</span>
    <?php else: ?>
        <span>Don't have an account? You can <a href="/register" class="text-blue-600 hover:underline">register
                here</a>!</span>
    <?php endif; ?>
    <span>Forgot password? No problem, you can <a href="/reset" class="text-blue-600 hover:underline">reset here</a>!</span>
</form>