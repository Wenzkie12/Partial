document.getElementById('toggleFormButton').addEventListener('click', function() {
    const form = document.getElementById('addBookForm');
    const button = document.getElementById('toggleFormButton');


    if (form.style.display === 'none') {
        form.style.display = 'block';
        button.textContent = 'Hide Add Book Form';
    } else {
        form.style.display = 'none';
        button.textContent = 'Show Add Book Form';
    }
});

function showEditForm(id, name, author, date_published, category, quantity) {
 
    document.getElementById('editBookForm').style.display = 'block';
    document.getElementById('edit_book_id').value = id;
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_author').value = author;
    document.getElementById('edit_date_published').value = date_published;
    document.getElementById('edit_category').value = category;
    document.getElementById('edit_quantity').value = quantity;


    const form = document.getElementById('editBookForm');
    form.action = form.action.replace('edit_id', id); 
}
