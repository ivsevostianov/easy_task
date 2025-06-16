<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    /**
     * Determine if the user can view any tasks.
     */
    public function viewAny(User $user): bool
    {
        return true; // Authenticated users can view their own tasks
    }

    /**
     * Determine if the user can view the task.
     * CRITICAL: Prevents IDOR attacks - users can only view their own tasks
     */
    public function view(User $user, Task $task): bool
    {
        return $user->id === $task->user_id;
    }

    /**
     * Determine if the user can create tasks.
     */
    public function create(User $user): bool
    {
        return true; // All authenticated users can create tasks
    }

    /**
     * Determine if the user can update the task.
     * CRITICAL: Prevents IDOR attacks - users can only update their own tasks
     */
    public function update(User $user, Task $task): bool
    {
        return $user->id === $task->user_id;
    }

    /**
     * Determine if the user can delete the task.
     * CRITICAL: Prevents IDOR attacks - users can only delete their own tasks
     */
    public function delete(User $user, Task $task): bool
    {
        return $user->id === $task->user_id;
    }
}
