<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of admin users.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $users = User::where('role', 'admin')
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->paginate(15);

        return view('admin.users.index', compact('users', 'search'));
    }

    /**
     * Show the form for creating a new admin user.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created admin user in database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => strip_tags($validated['name']),
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'admin',
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Admin user berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        // Prevent editing non-admin users
        if ($user->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses ke user ini');
        }

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user in database.
     */
    public function update(Request $request, User $user)
    {
        // Prevent editing non-admin users
        if ($user->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses ke user ini');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
        ]);

        $user->update([
            'name' => strip_tags($validated['name']),
            'email' => $validated['email'],
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Admin user berhasil diperbarui');
    }

    /**
     * Delete the specified user.
     */
    public function destroy(User $user, Request $request)
    {
        // Prevent deleting non-admin users
        if ($user->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses ke user ini');
        }

        // Prevent deleting own account
        if ($user->id === $request->user()->id) {
            return back()->with('error', 'Anda tidak bisa menghapus akun Anda sendiri');
        }

        $email = $user->email;
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', "Admin user {$email} berhasil dihapus");
    }

    /**
     * Show the form for changing password.
     */
    public function showChangePassword()
    {
        return view('admin.users.change-password');
    }

    /**
     * Update user password.
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = $request->user();

        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors([
                'current_password' => 'Password saat ini tidak sesuai',
            ]);
        }

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'Password berhasil diubah');
    }
}
