<x-app-layout>
    @section('content')

<form id="addBookForm" action="{{ route('books.store') }}" method="POST" style="display: none; margin-top: 20px;">
    @csrf
    <div>
        <label for="name">Book Name:</label>
        <input type="text" id="name" name="name" required>
    </div>
    <div>
        <label for="author">Author:</label>
        <input type="text" id="author" name="author" required>
    </div>
    <div>
        <label for="date_published">Date Published:</label>
        <input type="year" id="date_published" name="date_published" required>
    </div>
    <div>
        <label for="category">Category:</label>
        <input type="text" id="category" name="category" required>
    </div>
    <div>
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" min="0" required>
    </div>
    <button type="submit" class="toggle-btn">Add Book</button>
</form>

@endsection
</x-app-layout>