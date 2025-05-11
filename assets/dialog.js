const dialog = document.querySelector('dialog');
const div = document.querySelector('div[data-dialog]');

dialog.addEventListener('keydown', (e) => {
    if (e.key == 'Escape') {
        e.preventDefault();
        closeDialog();
    }
});

function openDialog() {
    dialog.classList.remove('hide');
    div.classList.remove('hide');
    dialog.classList.add('show');
    div.classList.add('show');
    dialog.showModal();
}

function closeDialog() {
    const abortController = new AbortController();
    dialog.classList.remove('show');
    div.classList.remove('show');
    dialog.classList.add('hide');
    div.classList.add('hide');
    document.addEventListener(
        'animationend',
        () => {
            dialog.close();
            abortController.abort();
        },
        { signal: abortController.signal },
    );
}
