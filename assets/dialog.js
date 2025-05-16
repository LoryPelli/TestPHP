const dialog = document.querySelector('dialog');
const div = document.querySelector('div[data-dialog]');

dialog.addEventListener('keydown', (e) => {
    if (e.key == 'Escape') {
        e.preventDefault();
        closeDialog();
    }
});

function openDialog() {
    div.setAttribute('data-show', '');
    dialog.showModal();
}

function closeDialog() {
    const abortController = new AbortController();
    div.removeAttribute('data-show');
    document.addEventListener(
        'animationend',
        () => {
            dialog.close();
            abortController.abort();
        },
        { signal: abortController.signal },
    );
}
