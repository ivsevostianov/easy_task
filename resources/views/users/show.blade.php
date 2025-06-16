<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Profile - {{ $user->name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="min-h-screen bg-gray-900 text-gray-200 antialiased">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-purple-400">
                User Profile
            </h1>
            <div class="flex space-x-4">
                <a href="{{ route('tasks.index') }}"
                   class="px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded-lg transition-colors">
                    📋 My Tasks
                </a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded-lg transition-colors">
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- IDOR Security Notice -->
        <div class="mb-6 p-4 bg-red-900/30 border border-red-700 rounded-lg">
            <div class="flex items-center space-x-2 mb-2">
                <svg class="w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
                <h3 class="text-red-400 font-semibold">🔒 IDOR Protection Demo</h3>
            </div>
            <p class="text-red-300 text-sm mb-2">
                <strong>Try this IDOR attack test:</strong> Change the URL to
                <code class="bg-gray-800 px-2 py-1 rounded">/users/{{ $user->id === 1 ? '2' : '1' }}</code>
                and see what happens!
            </p>
            <p class="text-gray-300 text-xs">
                You should get a 403 Forbidden error because you can only view your own profile (User ID: {{ $user->id }})
            </p>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-900/30 border border-green-700 rounded-lg">
                <p class="text-green-300">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Profile Information Card -->
        <div class="backdrop-blur-xl bg-gray-800/30 border border-gray-700 rounded-xl p-8 shadow-2xl mb-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-semibold text-white">Profile Information</h2>
                @can('update', $user)
                    <a href="{{ route('users.edit', $user) }}"
                       class="px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-medium rounded-lg hover:from-blue-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-900 transition-all duration-200">
                        Edit Profile
                    </a>
                @endcan
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Name</label>
                    <div class="p-3 bg-gray-900/50 border border-gray-600 rounded-lg">
                        <p class="text-white font-semibold">{{ $user->name }}</p>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                    <div class="p-3 bg-gray-900/50 border border-gray-600 rounded-lg">
                        <p class="text-white">{{ $user->email }}</p>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">User ID</label>
                    <div class="p-3 bg-gray-900/50 border border-gray-600 rounded-lg">
                        <p class="text-blue-400 font-mono">#{{ $user->id }}</p>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Member Since</label>
                    <div class="p-3 bg-gray-900/50 border border-gray-600 rounded-lg">
                        <p class="text-white">{{ $user->created_at->format('M j, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Task Statistics -->
        <div class="backdrop-blur-xl bg-gray-800/30 border border-gray-700 rounded-xl p-8 shadow-2xl mb-8">
            <h3 class="text-xl font-semibold text-white mb-4">Task Statistics</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center">
                    <div class="text-3xl font-bold text-blue-400 mb-2">{{ $totalTasks }}</div>
                    <div class="text-gray-300">Total Tasks</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-green-400 mb-2">{{ $recentTasks->count() }}</div>
                    <div class="text-gray-300">Recent Tasks</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-purple-400 mb-2">{{ $user->created_at->diffInDays(now()) }}</div>
                    <div class="text-gray-300">Days Active</div>
                </div>
            </div>
        </div>

        <!-- Recent Tasks -->
        @if($recentTasks->count() > 0)
        <div class="backdrop-blur-xl bg-gray-800/30 border border-gray-700 rounded-xl p-8 shadow-2xl mb-8">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-semibold text-white">Recent Tasks</h3>
                <a href="{{ route('tasks.index') }}" class="text-blue-400 hover:text-blue-300 text-sm">
                    View All →
                </a>
            </div>
            <div class="space-y-4">
                @foreach($recentTasks as $task)
                    <div class="p-4 bg-gray-900/50 border border-gray-600 rounded-lg hover:border-gray-500 transition-colors">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="font-semibold text-white">{{ $task->title }}</h4>
                                <p class="text-gray-400 text-sm mt-1">{{ Str::limit($task->description, 100) }}</p>
                                <p class="text-gray-500 text-xs mt-2">{{ $task->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('tasks.show', $task) }}"
                                   class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded">
                                    View
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Security Features Panel -->
        <div class="backdrop-blur-xl bg-blue-900/20 border border-blue-700 rounded-xl p-6">
            <h3 class="text-lg font-semibold text-blue-400 mb-4">🛡️ Security Features Active</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div class="space-y-2">
                    <div class="flex items-center space-x-2">
                        <span class="text-green-400 font-bold">✓</span>
                        <span><strong>IDOR Prevention:</strong> URL tampering blocked</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-green-400 font-bold">✓</span>
                        <span><strong>Laravel Policies:</strong> Authorization enforced</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-green-400 font-bold">✓</span>
                        <span><strong>User Scoping:</strong> Data isolation per user</span>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex items-center space-x-2">
                        <span class="text-green-400 font-bold">✓</span>
                        <span><strong>Session Security:</strong> HttpOnly + Secure cookies</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-green-400 font-bold">✓</span>
                        <span><strong>CSRF Protection:</strong> Forms protected</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-green-400 font-bold">✓</span>
                        <span><strong>Principle of Least Privilege:</strong> Minimal access</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-3 bg-yellow-900/30 border border-yellow-700 rounded-lg">
                <p class="text-yellow-300 text-sm">
                    <strong>🔍 IDOR Test Instructions:</strong> Try changing the user ID in the URL to access another user's profile.
                    You should receive a 403 Forbidden error, proving the IDOR protection is working!
                </p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
