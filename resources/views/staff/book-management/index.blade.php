<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book Management') }}
        </h2>
    </x-slot>

    <!-- Link to the CSS file -->
    <link rel="stylesheet" href="{{ asset('css/books.css') }}">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">

                <!-- Search and Add Book Buttons -->
                <div class="search-and-add">
                    <!-- Search Form -->
                    <div class="search">
                        <form action="{{ route('books.search') }}" method="GET">
                            <input type="text" name="search" placeholder="Search books..." value="{{ request('search') }}" class="search-input">
                            <button type="submit" class="btn btn-primary search-button">Search</button>
                        </form>
                    </div>
                    <!-- Show Add Book Button -->
                    <button id="toggleFormButton" class="toggle-btn">Show Add Book Form</button>
                </div>

                <!-- Add Book Form -->
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
                        <input type="date" id="date_published" name="date_published" required>
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

                <!-- Book List -->
                <table class="book-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Author</th>
                            <th>Date Published</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                        <tr>
                            <td>{{ $book->id }}</td>
                            <td>{{ $book->name }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->date_published }}</td>
                            <td>{{ $book->category }}</td>
                            <td>{{ $book->quantity }}</td>
                            <td>
                                <!-- Edit Book Button -->
                                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-info">Edit</a>

                                <!-- Delete Book Form -->
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Link to JavaScript file -->
    <script src="{{ asset('javascript/books.js') }}"></script>
</x-app-layout>
