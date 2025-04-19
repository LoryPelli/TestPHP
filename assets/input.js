const inputs = document.querySelectorAll('input');
inputs.forEach((input, i) => {
    if (i != 0 && input.value.length == 0) {
        input.disabled = true;
    }
    input.addEventListener('input', () => {
        input.value = (input.value[0] || '').replace(/[^0-9]/, '');
        if (input.value.length == 1) {
            (inputs[i + 1] || {}).disabled = false;
            inputs[i + 1]?.focus();
        }
    });
    input.addEventListener('keydown', (e) => {
        if (i != 0 && e.key == 'Backspace' && input.value.length == 0) {
            input.disabled = true;
            (inputs[i - 1] || {}).disabled = false;
            inputs[i - 1]?.focus();
        } else if (e.key == 'ArrowLeft') {
            if (input.value.length == 0) {
                input.disabled = true;
            }
            (inputs[i - 1] || {}).disabled = false;
            inputs[i - 1]?.focus();
        } else if (e.key == 'ArrowRight') {
            (inputs[i + 1] || {}).disabled = false;
            inputs[i + 1]?.focus();
        }
    });
    input.addEventListener('paste', (e) => {
        e.preventDefault();
        const data = e.clipboardData.getData('text');
        const chars = data.trim().split('');
        for (let j = 0; j < chars.length; j++) {
            if (i + j < inputs.length) {
                inputs[i + j].disabled = false;
                inputs[i + j].value = chars[j];
            }
        }
    });
});
