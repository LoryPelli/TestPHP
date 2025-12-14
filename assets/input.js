const inputs = document.querySelectorAll('input');
inputs.forEach((input, i) => {
    input.addEventListener('input', () => {
        input.value = (input.value[0] || '').replace(/[^0-9]/, '');
        if (input.value.length == 1) {
            inputs[i + 1]?.focus();
        }
    });
    input.addEventListener('keydown', (e) => {
        if (
            e.key == 'ArrowLeft' ||
            (e.key == 'Backspace' && input.value.length == 0)
        ) {
            e.preventDefault();
            inputs[i - 1]?.focus();
        } else if (e.key == 'ArrowRight') {
            e.preventDefault();
            inputs[i + 1]?.focus();
        }
    });
    input.addEventListener('paste', (e) => {
        e.preventDefault();
        const data = (e.clipboardData?.getData('text') || '').replace(
            /[^0-9]/g,
            '',
        );
        const chars = data.trim().split('');
        for (let j = 0; j < chars.length; j++) {
            if (i + j < inputs.length) {
                inputs[i + j].value = chars[j];
            }
        }
    });
});
