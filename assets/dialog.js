const dialog = document.querySelector('dialog');
const form = dialog.querySelector('form');
const div = document.querySelector('div[data-dialog]');

dialog.addEventListener('keydown', (e) => {
    if (e.key == 'Escape') {
        e.preventDefault();
        closeDialog();
    }
});

/**
 * @param { string } name
 * @param { string } description
 * @param { boolean } is_done
 */

function openDialog(name, description, is_done) {
    const form = dialog.querySelector('form');
    if (name && description) {
        form.setAttribute('action', '/api/edit');
        const inputs = form.querySelectorAll('input');
        inputs.forEach((i) => {
            switch (i.getAttribute('name')) {
                case 'name': {
                    i.setAttribute('value', name);
                    break;
                }
                case 'description': {
                    i.setAttribute('value', description);
                    break;
                }
                case 'is_done': {
                    if (is_done) {
                        i.setAttribute('checked', '');
                    }
                    break;
                }
            }
        });
    } else {
        form.setAttribute('action', '/api/add');
    }
    div.setAttribute('data-open', '');
    dialog.showModal();
}

function closeDialog() {
    const abortController = new AbortController();
    div.removeAttribute('data-open');
    form.removeAttribute('action');
    document.addEventListener(
        'animationend',
        () => {
            dialog.close();
            abortController.abort();
        },
        { signal: abortController.signal },
    );
}
