<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function index()
{
    $users = User::all();
    return view('management.index', ['users' => $users]);
}


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'roles' => 'array|nullable'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('default_password'), 
        ]);

        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        return redirect()->route('management.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $userRoles = $user->roles->pluck('name')->toArray();
        $roles = Role::pluck('name')->toArray(); 
        return view('management.edit', [
            'user' => $user,
            'roles' => $roles,
            'userRoles' => $userRoles
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        $user->update($data);

        if ($request->roles) {
            $user->syncRoles($request->roles);
        }

        return redirect()->route('management.index')->with('success', 'User updated successfully with roles.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('management.index')->with('success', 'User deleted successfully.');
    }

    public function search(Request $request)
{
    $search = $request->input('search');

    $users = User::where('name', 'like', '%' . $search . '%')
                 ->orWhere('email', 'like', '%' . $search . '%')
                 ->get();

    return view('management.index', compact('users'))->with('search', $search);
}

public function personalInfo()
{
    $user = Auth::user(); // Get the logged-in user

    return view('user.personal', compact('user'));
}

}