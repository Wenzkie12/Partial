<x-app-layout>
    @section('content')

    <link rel="stylesheet" href="{{ asset('css/books.css') }}">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                <h2>Penalty List</h2>

                <div class="table-wrapper">
                    <table class="fl-table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Penalty Amount</th>
                                <th>Date Issued</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penalties as $penalty)
                            <tr>
                                <td>{{ $penalty->user->name }}</td>
                                <td>₱{{ number_format($penalty->amount, 2) }}</td>
                                <td>{{ $penalty->created_at }}</td>
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
