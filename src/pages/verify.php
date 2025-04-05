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
                class="w-12 p-1 text-center border-2 border-black rounded-md " />
        <?php endforeach; ?>
    </div>
    <button type="submit" class="p-1 border-2 border-black rounded-md">Verify</button>
    <script>
const inputs = document.querySelectorAll('input');
inputs.forEach((input, i) => {
    input.addEventListener('input', () => {
        if (input.value.length == 1 && i < inputs.length - 1) {
            inputs[i + 1].focus();
        }
    });
    input.addEventListener('keydown', (e) => {
        if (e.key == 'Backspace' && input.value.length == 0 && i > 0) {
            inputs[i - 1].focus();
        }
    });
    input.addEventListener('paste', (e) => {
        e.preventDefault();
        const paste = e.clipboardData.getData('text');
        const chars = paste.trim().split('');
        for (let j = 0; j < chars.length; j++) {
            if (i + j < inputs.length) {
                inputs[i + j].value = chars[j];
            }
        }
        const nextIndex = Math.min(i + chars.length, inputs.length - 1);
        inputs[nextIndex].focus();
    });
});
    </script>
</form>
