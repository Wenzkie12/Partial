<x-app-layout>
    @section('content')
    <link rel="stylesheet" href="{{ asset('css/books.css') }}">
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-5">
                    <div class="card-header">
                        <span>Edit User</span>
                        <a href="{{ route('management.index') }}" class="btn btn-danger btn-sm float-end">Back</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('management.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name">User Name</label>
                                <input type="text" name="name" value="{{ $user->name }}" class="form-control" required />
                            </div>
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" value="{{ $user->email }}" class="form-control" required />
                            </div>
                            <div class="mb-3">
                                <label for="password">Password (optional)</label>
                                <input type="password" readonly name="password" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label for="roles">Roles</label>
                                <select name="roles[]" class="form-control" multiple>
                                    @foreach($roles as $role)
                                        <option value="{{ $role }}" {{ in_array($role, $userRoles) ? 'selected' : '' }}>
                                            {{ $role }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Update User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection
</x-app-layout>
   
