const passwords = document.querySelectorAll('div[data-pwd]');
const svgs = document.querySelectorAll('div[data-svg]');
let visible = false;
passwords.forEach((pwd, i) => {
    if (!svgs[i].innerHTML) {
        svgs[i].innerHTML = disabledcapslock;
    }
    const input = pwd.querySelector('input');
    input.addEventListener('keydown', (e) => {
        svgs[i].innerHTML = e.getModifierState('CapsLock')
            ? capslock
            : disabledcapslock;
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
