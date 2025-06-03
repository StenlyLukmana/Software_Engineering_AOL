<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subject;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function dashboard()
    {
        $title = 'Admin Dashboard';
        $users = User::count();
        $subjects = Subject::count();
        $materials = Material::count();
        $recentUsers = User::latest()->take(5)->get();
        
        return view('admin.dashboard', compact('title', 'users', 'subjects', 'materials', 'recentUsers'));
    }

    public function users()
    {
        $title = 'User Management';
        $users = User::orderBy('name')->paginate(15);
        return view('admin.users', compact('title', 'users'));
    }

    public function createUser()
    {
        $title = 'Create New User';
        return view('admin.create-user', compact('title'));
    }

    public function storeUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,lecturer,student',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'email_verified_at' => now(),
        ]);

        return redirect()->route('admin.users')->with('success', 'User created successfully!');
    }

    public function editUser(User $user)
    {
        $title = 'Edit User';
        return view('admin.edit-user', compact('title', 'user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,lecturer,student',
            'password' => 'nullable|string|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $user->update($updateData);

        return redirect()->route('admin.users')->with('success', 'User updated successfully!');
    }

    public function deleteUser(User $user)
    {
        if ($user->id === auth()->user()->id) {
            return redirect()->back()->with('error', 'You cannot delete your own account!');
        }

        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted successfully!');
    }
}
