<x-app-layout>
    @section('content')

    <link rel="stylesheet" href="{{ asset('css/books.css') }}">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                <h2>Reservation List</h2>

                <div class="table-wrapper">
                    <table class="fl-table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Book</th>
                                <th>Reservation Date</th>
                                <th>Created At</th>
                                <th>Action</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservations as $reservation)
                            <tr>
                                <td>{{ $reservation->user->name }}</td>
                                <td>{{ $reservation->book->name }}</td>
                                <td>{{ $reservation->reservation_date }}</td>
                                <td>{{ $reservation->created_at }}</td>
                                <td>
                                    <form action="{{ route('reservations.claim', $reservation->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="claim-btn">Claim</button>
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
