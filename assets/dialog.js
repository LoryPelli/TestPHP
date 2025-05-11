const dialog = document.querySelector('dialog');
const div = document.querySelector('div[data-dialog]');

dialog.addEventListener('keydown', (e) => {
    if (e.key == 'Escape') {
        e.preventDefault();
        closeDialog();
    }
});

function openDialog() {
    div.classList.remove('hide');
    div.classList.add('show');
    dialog.showModal();
}

function closeDialog() {
    const abortController = new AbortController();
    div.classList.remove('show');
    div.classList.add('hide');
    document.addEventListener(
        'animationend',
        () => {
            dialog.close();
            abortController.abort();
        },
        abortController,
    );
}
