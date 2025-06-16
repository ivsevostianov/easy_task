<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine if the user can view any users.
     * Principle of Least Privilege: Users can only see themselves
     */
    public function viewAny(User $user): bool
    {
        return true; // Redirect will handle showing only own profile
    }

    /**
     * Determine if the user can view the user profile.
     * CRITICAL: Prevents IDOR attacks - users can only view their own profile
     */
    public function view(User $currentUser, User $targetUser): bool
    {
        // Only allow users to view their own profile
        return $currentUser->id === $targetUser->id;
    }

    /**
     * Determine if the user can update the user profile.
     * CRITICAL: Prevents IDOR attacks - users can only update their own profile
     */
    public function update(User $currentUser, User $targetUser): bool
    {
        // Only allow users to update their own profile
        return $currentUser->id === $targetUser->id;
    }

    /**
     * Determine if the user can delete the user profile.
     * CRITICAL: Prevents IDOR attacks - users can only delete their own profile
     */
    public function delete(User $currentUser, User $targetUser): bool
    {
        // Only allow users to delete their own profile
        return $currentUser->id === $targetUser->id;
    }
}
