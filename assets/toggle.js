const passwords = document.querySelectorAll('div');
let visible = false;
passwords.forEach((pwd) => {
    const input = pwd.querySelector('input');
    const button = pwd.querySelector('button');
    if (button.innerHTML.length == 0) {
        button.innerHTML = show;
    }
    button.addEventListener('click', () => {
        visible = !visible;
        input.type = visible ? 'text' : 'password';
        button.innerHTML = visible ? hide : show;
    });
});
