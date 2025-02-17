<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Book') }}
        </h2>
    </x-slot>
    <link rel="stylesheet" href="{{ asset('css/books.css') }}">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                <form action="{{ route('books.update', $book->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="name">Book Name:</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $book->name) }}" required>
                    </div>
                    <div>
                        <label for="author">Author:</label>
                        <input type="text" id="author" name="author" value="{{ old('author', $book->author) }}" required>
                    </div>
                    <div>
                        <label for="date_published">Date Published:</label>
                        <input type="date" id="date_published" name="date_published" value="{{ old('date_published', $book->date_published) }}" required>
                    </div>
                    <div>
                        <label for="category">Category:</label>
                        <input type="text" id="category" name="category" value="{{ old('category', $book->category) }}" required>
                    </div>
                    <div>
                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" value="{{ old('quantity', $book->quantity) }}" min="0" required>
                    </div>
                    <button type="submit">Update Book</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
