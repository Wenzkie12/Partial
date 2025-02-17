<x-app-layout>
    @section('content')

    <link rel="stylesheet" href="{{ asset('css/books.css') }}">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                <h2>To Return List</h2>

                <div class="table-wrapper">
                    <table class="fl-table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Book</th>
                                <th>Claimed At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($toReturnItems as $item)
                            <tr>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->book->name }}</td>
                                <td>{{ $item->claimed_at }}</td>
                                <td>
                                    <form action="{{ route('books.return', $item->id) }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn">Return</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @endsection
</x-app-layout>
