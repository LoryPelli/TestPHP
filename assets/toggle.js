const passwords = document.querySelectorAll('div[data-pwd]');
const svgs = document.querySelectorAll('div[data-svg]');
let visible = false;
passwords.forEach((pwd, i) => {
    if (!svgs[i].innerHTML) {
        svgs[i].innerHTML = disabledcapslock;
    }
    const input = pwd.querySelector('input');
    input.addEventListener('keydown', (e) => {
        if (e.getModifierState('CapsLock')) {
            svgs[i].innerHTML = capslock;
        } else {
            svgs[i].innerHTML = disabledcapslock;
        }
    });
    const button = pwd.querySelector('button');
    if (!button.innerHTML) {
        button.innerHTML = show;
    }
    button.addEventListener('click', () => {
        visible = !visible;
        input.type = visible ? 'text' : 'password';
        button.innerHTML = visible ? hide : show;
    });
});
