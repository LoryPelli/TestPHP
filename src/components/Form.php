<?php
require_once 'src/enums/Type.php';
require_once 'src/enums/UserError.php';
$isLogin = $type == Type::Login;
$error = $_GET['error'] ?? '';
?>
<form method="POST" class="flex flex-col items-center justify-center h-screen gap-y-1" action="<?= sprintf(
    '/api/%s',
    $isLogin ? 'login' : 'register'
) ?>">
    <?php if (isset($messages[$error])): ?>
    <div class="p-2 font-bold text-white bg-red-500 rounded-md">
        <span><?= $messages[$error] ?>!</span>
    </div>
    <?php endif; ?>
    <?php include_once 'src/components/Fields.php'; ?>
    <button type="submit" class="p-1 border-2 rounded-md cursor-pointer"><?= $isLogin
        ? 'Login!'
        : 'Register!' ?></button>
    <?php if (!$isLogin): ?>
    <span>Already have an account? You can <a href="/login" class="text-blue-600 hover:underline">Login here</a>!</span>
    <?php else: ?>
    <span>Don't have an account? You can <a href="/register" class="text-blue-600 hover:underline">Register here</a>!</span>
    <?php endif; ?>
</form>
