<x-app-layout>
    @section('content')
    <link href="{{ asset('css/books.css') }}" rel="stylesheet">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">
                     
                        <div class="row">
                            <div class="col-md-12">
                                @if(session('status'))
                                    <div class="alert alert-success mt-3">{{ session('status') }}</div>
                                @endif
                                <div class="mt-5 card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <span>Users</span>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Roles</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($users as $user)
                                                    <tr>
                                                        <td>{{ $user->id }}</td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>
                                                            @if ($user->getRoleNames()->isNotEmpty())
                                                                @foreach ($user->getRoleNames() as $roleName)
                                                                    <label class="badge text-bg-warning mt-2 mx-3 md-3">{{ $roleName }}</label>
                                                                @endforeach
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if(Auth::user()->hasRole('admin') == false)
                                                                <a href="{{ route('management.edit', $user->id) }}" class="btn btn-success">Edit</a>
                                                            @endif
                                                            <form action="{{ route('management.destroy', $user->id) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-app-layout>
