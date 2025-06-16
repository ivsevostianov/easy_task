<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Redirect root to login
Route::get('/', function () {
    return redirect('/login');
});

// Include separate auth routes file
require __DIR__.'/auth.php';

// Test 500 error route
Route::get('/test-500', function () {
    abort(500, 'This is a test server error');
});

// Protected routes
Route::middleware('auth')->group(function () {
    // Logout route
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    // Redirect dashboard to tasks
    Route::get('/dashboard', function () {
        return redirect('/tasks');
    })->name('dashboard');

    // Task routes - with IDOR protection via policies
    Route::resource('tasks', TaskController::class);

    // User profile routes - demonstrates IDOR protection
    Route::resource('users', UserController::class)->only(['index', 'show', 'edit', 'update']);
});
