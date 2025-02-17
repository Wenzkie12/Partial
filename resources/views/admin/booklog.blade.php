<x-app-layout>
    @section('content')
    
    
    <link rel="stylesheet" href="{{ asset('css/books.css') }}">
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
               
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Book ID</th>
                            <th>Action</th>
                            <th>Description</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookLogs as $log)
                            <tr>
                                <td>{{ $log->id }}</td>
                                <td>{{ $log->name }}</td>
                                <td>{{ $log->book_id }}</td>
                                <td>{{ $log->action }}</td>
                                <td>{{ $log->description }}</td>
                                <td>{{ $log->created_at }}</td>
                                <td>{{ $log->updated_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
               
                <div class="mt-4">
                    {{ $bookLogs->links() }}
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-app-layout>
