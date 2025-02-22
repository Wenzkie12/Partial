<x-app-layout>
    @section('content')
    <link rel="stylesheet" href="{{ asset('css/books.css') }}">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h2>Reservations</h2>
        <table>
            <thead>
                <tr>
                    <th>Book</th>
                    <th>Status</th>
                    <th>Reservation Date</th>
                    <th>Claimed At</th>
                    <th>Returned At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($trackingRecords as $item)
                    <tr>
                        <td>{{ $item->book->name }}</td>
                        <td>{{ ucfirst($item->status) }}</td> <!-- Capitalize the status -->
                        <td>{{ $item->reservation_date }}</td>
                        <td>{{ $item->claimed_at ?? '' }}</td>
                        <td>{{ $item->returned_at ?? '' }}</td>
                        <td>
                            @if ($item->status === 'pending')
                               <form action="{{ route('reservation.cancel', $item->reservation_id) }}" method="POST">
    @csrf
    @method('DELETE') <!-- Change this from PUT to DELETE -->
    <button type="submit" class="btn btn-warning">Cancel</button>
</form>

                            @else
                                <span class="text-muted">No action available</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endsection
</x-app-layout>
