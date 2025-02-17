<x-app-layout>
    @section('content')
    

    <link rel="stylesheet" href="{{ asset('css/books.css') }}">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                <div class="search-and-add">
                    <div class="search">
                        <form action="{{ route('users.search') }}" method="GET" class="search-form">
                            <input type="text" name="search" placeholder="Search users..." value="{{ request('search') }}" class="search-input">
                            <button type="submit" class="btn search-button">Search</button>
                        </form>
                    </div>

                  
                </div>
                

                <div class="table-wrapper">
                    <table class="fl-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->getRoleNames()->isNotEmpty())
                                        @foreach ($user->getRoleNames() as $roleName)
                                            <label class="badge">{{ $roleName }}</label>
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    @if (auth()->user()->hasRole('superadmin'))
                                        <a href="{{ route('management.edit', $user->id) }}" class="btn btn-success">Edit</a>
                                        <form action="{{ route('management.destroy', $user->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete">Delete</button>
                                        </form>
                                    @elseif (auth()->user()->hasRole('admin'))
                                        <form action="{{ route('management.destroy', $user->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete">Delete</button>
                                        </form>
                                    @endif
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