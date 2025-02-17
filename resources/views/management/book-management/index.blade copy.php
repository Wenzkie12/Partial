<x-app-layout>
    @section('content')
    

    <link rel="stylesheet" href="{{ asset('css/books.css') }}">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                <div class="search-and-add">
                    <div class="search">
                        <form action="{{ route('books.search') }}" method="GET">
                            <input type="text" name="search" placeholder="Search books..." value="{{ request('search') }}" class="search-input">
                            <button type="submit" class="btn btn-primary search-button">Search</button>
                        </form>
                    </div>

                    @if (!auth()->user()->hasRole('user'))
                        <button id="toggleFormButton" class="toggle-btn">Show Add Book Form</button>
                    @endif
                </div>

                @if (!auth()->user()->hasRole('user'))
                    <!-- <form id="addBookForm" action="{{ route('books.store') }}" method="POST" style="display: none; margin-top: 20px;">
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
                    </form> -->
                @endif

                <div class="table-wrapper">
                    <table class="fl-table">
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
                                    @if (!auth()->user()->hasRole('user'))
                                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-info">Edit</a>
                                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    @endif
                                    @if(auth()->user()->hasRole('user') && $book->quantity > 0)
                                    <form action="{{ route('books.reserve', $book->id) }}" method="POST">
                                        @csrf
                                        <label for="reservation_date">Pick-up Date:</label>
                                        <input type="date" name="reservation_date" required min="{{ now()->toDateString() }}">
                                        <button type="submit" class="btn btn-primary">Reserve</button>
                                    </form>
                                @endif
                                
                                    {{-- @if (auth()->user()->hasRole('user') && $book->quantity > 0)
                                        <form action="{{ route('books.reserve', $book->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Reserve</button>
                                        </form>
                                    @endif --}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/books.js') }}"></script>
    @endsection
</x-app-layout>
