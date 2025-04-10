<?php
require_once 'src/enums/UserError.php';
$error = $_GET['error'] ?? '';
?>
<form method="POST" class="flex flex-col items-center justify-center h-screen gap-y-1" action="/api/verify">
    <?php if (isset($messages[$error])): ?>
        <div class="p-2 font-bold text-white bg-red-500 rounded-md">
            <span><?= $messages[$error] ?>!</span>
        </div>
    <?php endif; ?>
    <span class="text-xl font-bold">A verification code has been sent to your email, please enter it to complete
        registration!</span>
    <div class="flex gap-x-1">
        <?php foreach (range(0, 5) as $_): ?>
            <input name="digit[]" autocomplete="off" type="number" min="0" max="9" required
                class="w-12 p-1 text-center border-2 rounded-md disabled:bg-gray-200 disabled:cursor-not-allowed" />
        <?php endforeach; ?>
    </div>
    <button type="submit" class="p-1 border-2 rounded-md cursor-pointer">Verify!</button>
    <script src="/assets/input.js"></script>
</form>