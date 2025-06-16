<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Task Details - {{ $task->title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="min-h-screen bg-gray-900 text-gray-200 antialiased">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-purple-400">
                Task Details
            </h1>
            <div class="flex space-x-4">
                <a href="{{ route('tasks.index') }}"
                   class="px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded-lg transition-colors">
                    ← Back to Tasks
                </a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded-lg transition-colors">
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Security Notice -->
        <div class="mb-6 p-4 bg-green-900/30 border border-green-700 rounded-lg">
            <div class="flex items-center space-x-2 mb-2">
                <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <h3 class="text-green-400 font-semibold">🔒 IDOR Protection Active</h3>
            </div>
            <p class="text-green-300 text-sm">
                This task belongs to <strong>{{ $task->user->name }}</strong> (ID: {{ $task->user->id }}).
                Access is verified through Laravel Policies - you can only view tasks you own!
            </p>
        </div>

        <!-- Task Details Card -->
        <div class="backdrop-blur-xl bg-gray-800/30 border border-gray-700 rounded-xl p-8 shadow-2xl">
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-300 mb-2">Title</label>
                <div class="p-3 bg-gray-900/50 border border-gray-600 rounded-lg">
                    <h2 class="text-xl font-semibold text-white">{{ $task->title }}</h2>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-300 mb-2">Description</label>
                <div class="p-3 bg-gray-900/50 border border-gray-600 rounded-lg min-h-[100px]">
                    <p class="text-gray-200">{{ $task->description ?: 'No description provided.' }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Created</label>
                    <div class="p-3 bg-gray-900/50 border border-gray-600 rounded-lg">
                        <p class="text-gray-200">{{ $task->created_at->format('M j, Y g:i A') }}</p>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Last Updated</label>
                    <div class="p-3 bg-gray-900/50 border border-gray-600 rounded-lg">
                        <p class="text-gray-200">{{ $task->updated_at->format('M j, Y g:i A') }}</p>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex flex-wrap gap-4">
                @can('update', $task)
                    <a href="{{ route('tasks.edit', $task) }}"
                       class="px-6 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-medium rounded-lg hover:from-blue-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-900 transition-all duration-200 transform hover:scale-105">
                        Edit Task
                    </a>
                @endcan

                @can('delete', $task)
                    <form method="POST" action="{{ route('tasks.destroy', $task) }}" class="inline"
                          onsubmit="return confirm('Are you sure you want to delete this task?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-6 py-2 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-gray-900 transition-all duration-200">
                            Delete Task
                        </button>
                    </form>
                @endcan
            </div>
        </div>

        <!-- Security Information Panel -->
        <div class="mt-8 backdrop-blur-xl bg-blue-900/20 border border-blue-700 rounded-xl p-6">
            <h3 class="text-lg font-semibold text-blue-400 mb-4">🛡️ Security Features Demonstrated</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div class="space-y-2">
                    <div class="flex items-center space-x-2">
                        <span class="text-green-400">✓</span>
                        <span>IDOR Prevention via Policies</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-green-400">✓</span>
                        <span>Principle of Least Privilege</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-green-400">✓</span>
                        <span>Authorization on All Actions</span>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex items-center space-x-2">
                        <span class="text-green-400">✓</span>
                        <span>Session Security</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-green-400">✓</span>
                        <span>CSRF Protection</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-green-400">✓</span>
                        <span>User-Scoped Data Access</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
