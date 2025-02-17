<x-app-layout>
    @section('content')
    
    
    <script src="{{ asset('js/roles.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/roles.css') }}">
    <div class="role-container">

        
        @if(session('status'))
            <div class="status">{{ session('status') }}</div>
        @endif
    
        <div class="role-header">
            <h2>Roles Management</h2><br>
            <button class="btn-role-add" onclick="openModal('addRoleModal')">Add Role</button>
        </div>
    
        <div class="role-grid">
            @foreach($roles as $role)
                <div class="role-card">
                    <h4>{{ $role->name }}</h4>
                    <div class="actions">
                        <button class="btn-role" onclick="openModal('editPermissionsModal{{ $role->id }}')">Add/Edit Permissions</button>
                        <button class="btn-role" onclick="openModal('editRoleModal{{ $role->id }}')">Edit</button>
                        <form action="{{ url('roles/'.$role->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-role" onclick="return confirm('Are you sure you want to delete this role?')">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
    <div id="addRoleModal" class="modal">
        <div class="modal-content">
            <div class="x">
                <span class="close" onclick="closeModal('addRoleModal')">&times;</span>
            </div>
            
            <h2>Add Role</h2>
            <form action="{{ url('roles') }}" method="POST">
                @csrf
                <label for="name">Role Name</label>
                <input type="text" name="name" required>
               <div class="buttonss">
                <button type="submit" class="btn">Save</button>
               </div>
                
            </form>
        </div>
    </div>
    

    @foreach($roles as $role)
    <div id="editRoleModal{{ $role->id }}" class="modal">
        <div class="modal-content">
            <div class="x">
                <span class="close" onclick="closeModal('editRoleModal{{ $role->id }}')">&times;</span>
            </div>
            
            <h2>Edit Role</h2>
            <form action="{{ url('roles/'.$role->id) }}" method="POST">
                @csrf
                @method('PUT')
                <label for="name">Role Name</label>
                <input type="text" name="name" value="{{ $role->name }}" required>
                <div class="buttons">
                    <button type="submit" class="btn">Update</button>
                </div>
                
            </form>
        </div>
    </div>
    @endforeach
    
  
    @foreach($roles as $role)
    <div id="editPermissionsModal{{ $role->id }}" class="modal">
        <div class="modal-content">
            <div class="x">
                <span class="close" onclick="closeModal('editPermissionsModal{{ $role->id }}')">&times;</span>
            </div>
            
            <h2 class="name">Edit Permissions for {{ $role->name }}</h2>
            <form action="{{ route('roles.give-permissions', $role->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="permissions-list">
                    @foreach ($permissions as $permission)
                    <label>
                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" {{ $role->permissions->contains($permission) ? 'checked' : '' }}>
                        {{ $permission->name }}
                    </label>
                    @endforeach
                </div>
                <div class="buttonss">
                    <button type="submit" class="btn">Update</button>
                </div>
                
            </form>
        </div>
    </div>
    @endforeach
    
    @endsection
</x-app-layout>
