<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of users (only current user).
     * Demonstrates Principle of Least Privilege - users can only see themselves.
     */
    public function index()
    {
        // Users can only see their own profile - Principle of Least Privilege
        return redirect()->route('users.show', auth()->user());
    }

    /**
     * Display the specified user.
     * CRITICAL: Prevents IDOR - users can only view their own profile
     */
    public function show(User $user)
    {
        // IDOR Protection: Verify user can view this profile
        $this->authorize('view', $user);

        $userTasks = $user->tasks()->latest()->take(5)->get();

        return view('users.show', [
            'user' => $user,
            'recentTasks' => $userTasks,
            'totalTasks' => $user->tasks()->count()
        ]);
    }

    /**
     * Show the form for editing the specified user.
     * CRITICAL: Prevents IDOR - users can only edit their own profile
     */
    public function edit(User $user)
    {
        // IDOR Protection: Verify user can edit this profile
        $this->authorize('update', $user);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user.
     * CRITICAL: Prevents IDOR - users can only update their own profile
     */
    public function update(Request $request, User $user)
    {
        // IDOR Protection: Verify user can update this profile
        $this->authorize('update', $user);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        $user->update($validated);

        return redirect()->route('users.show', $user)
            ->with('success', 'Profile updated successfully!');
    }
}
