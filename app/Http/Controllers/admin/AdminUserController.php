<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    // List all users
    public function index()
    {
        $users = User::latest()->paginate(10);
        
        $notifications=Book::where('status','pending')->count('status');
        return view('admin.users.index', compact('notifications','users'));
    }

    // Show create user form
    public function create()
    {
        $notifications=Book::where('status','pending')->count('status');
        
        return view('admin.users.create',compact('notifications'));
    }

    // Store new user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string|in:admin,user',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    // Show edit form
    public function edit(User $user)
    {
         $notifications=Book::where('status','pending')->count('status');
        return view('admin.users.edit', compact('user','notifications','user'));
    }

    // Update user
    public function update(Request $request, User $user)
    {
        $request->validate([
                'name' => 'required|string|max:255',
                'name_ps'=>'nullable|max:255',
                'name_fa'=>'nullable|max:255',
                'email' => "required|email|unique:users,email,{$user->id}",
                'password' => 'nullable|string|min:6|confirmed',
                'role' => 'required|string|in:admin,user',
        ]);

        $user->name = $request->name;
        $user->name_ps=$request->name_ps;
        $user->name_fa=$request->name_fa;
        $user->email = $request->email;
        $user->role = $request->role;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    // Delete user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}