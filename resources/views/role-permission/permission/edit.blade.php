
<x-app-layout>
    @section('content')
    <link rel="stylesheet" href="{{ asset('css/books.css') }}">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="card mt-5">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Edit Permissions</span>
                            <a href="{{ url('permissions') }}">
                                <button type="button" class="btn btn-danger">Back</button>
                            </a>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('permissions/'.$permission->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="name">Permission Name</label>
                                    <input type="text" name="name" value="{{ $permission->name }}" class="form-control" required />
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
</x-app-layout>
        
