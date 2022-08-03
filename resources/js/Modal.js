let dialog = document.getElementById('dialog');
let closeButton = document.getElementById('close');
let overlay = document.getElementById('overlay');
let deleteItemForm = document.getElementById('delete-form');
let modalBody = document.getElementById('modal-body')

//Open modal
document.querySelectorAll('.open-delete-modal').forEach(item => {
    item.addEventListener('click', () => {
        let formAction = item.getAttribute('data-url');
        let entity = item.getAttribute('data-entity');
        let item_name = item.getAttribute('data-item');
        modalBody.innerHTML = 'Are you sure you want to delete the ' + entity + ': ' + item_name + '?';
        deleteItemForm.setAttribute('action', formAction)
        dialog.classList.remove('hidden');
        overlay.classList.remove('hidden');
    });
});

// hide the overlay and the dialog
closeButton.addEventListener('click', function () {
    dialog.classList.add('hidden');
    overlay.classList.add('hidden');
});
