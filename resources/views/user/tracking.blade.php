<x-app-layout>
    @section('content')
    <link rel="stylesheet" href="{{ asset('css/books.css') }}">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h2>Your Reservations</h2>
        <table>
            <thead>
                <tr>
                    <th>Book</th>
                    <th>Status</th>
                    <th>Reservation Date</th>
                    <th>Claimed At</th>
                    <th>Returned At</th>
                    <th>Remaining Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($trackingRecords as $item) 
                    <tr>
                        <td>{{ $item->book->name }}</td>
                        <td>{{ $item->status }}</td>
                        <td>{{ $item->reservation_date }}</td>
                        <td>{{ $item->claimed_at }}</td>
                        <td>{{ $item->returned_at }}</td>
                        <td>{{ $item->remaining_time }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endsection
</x-app-layout>
