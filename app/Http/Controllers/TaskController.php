<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;  // Add this line

class TaskController extends Controller
{
    use AuthorizesRequests;  // Add this line

    public function index()
    {
        // Only show tasks owned by the authenticated user (prevents IDOR)
        $tasks = auth()->user()->tasks()->latest()->get();
        return view('tasks.index', compact('tasks'));
    }

    public function show(Task $task)
    {
        // CRITICAL: Prevent IDOR - verify user owns this task
        $this->authorize('view', $task);

        return view('tasks.show', compact('task'));
    }

    public function create()
    {
        // Verify user can create tasks
        $this->authorize('create', Task::class);

        return view('tasks.create');
    }

    public function store(Request $request)
    {
        // Verify user can create tasks
        $this->authorize('create', Task::class);

        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
        ]);

        // Automatically assign to authenticated user (Principle of Least Privilege)
        auth()->user()->tasks()->create($validated);

        return redirect()->route('tasks.index')
            ->with('success', 'Task created successfully!');
    }

    public function edit(Task $task)
    {
        // CRITICAL: Prevent IDOR - verify user owns this task
        $this->authorize('update', $task);

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        // Authorize the request
        $this->authorize('update', $task);

        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')
            ->with('success', 'Task updated successfully!');
    }

    public function destroy(Task $task)
    {
        // Authorize the request
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Task deleted successfully!');
    }
}
