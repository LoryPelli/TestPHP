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
 * @param { string } id
 */

function openDialog(id) {
    const form = dialog.querySelector('form');
    const name = form.querySelector("input[name='name']");
    const description = form.querySelector("input[name='description']");
    const is_done = form.querySelector("input[name='is_done']");
    if (id) {
        form.setAttribute('action', '/api/edit');
        const todo = document.querySelector(`form[data-todo-${id}]`);
        const todo_name = todo
            .querySelector("input[name='name'")
            .getAttribute('value');
        const todo_description = todo
            .querySelector("input[name='description'")
            .getAttribute('value');
        const todo_is_done = todo
            .querySelector("input[name='is_done'")
            .hasAttribute('checked');
        if (todo_name) {
            name.setAttribute('value', todo_name);
        }
        if (todo_description) {
            description.setAttribute('value', todo_description);
        }
        if (todo_is_done) {
            is_done.setAttribute('checked', '');
        }
    } else {
        name.removeAttribute('value');
        description.removeAttribute('value');
        is_done.removeAttribute('checked');
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
