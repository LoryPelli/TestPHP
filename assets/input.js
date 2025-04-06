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
        const data = e.clipboardData.getData('text');
        const chars = data.trim().split('');
        for (let j = 0; j < chars.length; j++) {
            if (i + j < inputs.length) {
                inputs[i + j].value = chars[j];
            }
        }
        const nextIndex = Math.min(i + chars.length, inputs.length - 1);
        inputs[nextIndex].focus();
    });
});
