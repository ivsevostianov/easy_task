@extends('layouts.app')

@section('title', 'Tasks')

@section('content')
    <!-- Navigation -->
    <nav class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center space-x-4">
                    <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-500 to-purple-500">
                        Your Tasks
                    </span>
                    <!-- Profile Button - Test IDOR Protection -->
                    <a href="{{ route('users.show', auth()->user()) }}"
                       class="px-4 py-2 bg-gradient-to-r from-green-500 to-teal-600 text-white font-medium rounded-lg hover:from-green-600 hover:to-teal-700 transition-all duration-200 transform hover:scale-105">
                        👤 My Profile
                    </a>
                    <!-- About Button -->
                    <a href="/about"
                       class="px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-medium rounded-full hover:from-blue-600 hover:to-purple-700 transition-all duration-200 transform hover:scale-105">
                        About
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    <!-- Theme Toggle Button -->
                    <button id="theme-toggle" class="p-2 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                        <svg class="w-5 h-5 dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                        <svg class="w-5 h-5 hidden dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </button>
                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-medium rounded-full hover:from-blue-600 hover:to-purple-700 transition-all duration-200 transform hover:scale-105">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-1 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col items-center justify-center text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-2">Welcome Back! 👋</h1>
            <p class="text-gray-600 dark:text-gray-400 mb-6">Manage your tasks efficiently</p>
            <a href="{{ route('tasks.create') }}"
               class="px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-medium rounded-lg hover:from-blue-600 hover:to-purple-700 transition-all duration-200 transform hover:scale-105">
                Create New Task
            </a>
        </div>

        <!-- Tasks List -->
        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            @forelse($tasks as $task)
                <div class="group bg-white/80 dark:bg-gray-800/80 rounded-xl p-4 shadow-lg border border-gray-200 dark:border-gray-700 transform transition-all duration-200 hover:scale-105 cursor-pointer relative"
                     onclick="window.location='{{ route('tasks.edit', $task) }}'">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">
                        {{ $task->title }}
                    </h3>
                    <div class="mb-4">
                        <p class="text-gray-600 dark:text-gray-400 text-sm">
                            {{ Str::limit($task->description, 50) }}
                            @if (strlen($task->description) > 50)
                                <span class="text-blue-500">...</span>
                            @endif
                        </p>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('tasks.edit', $task) }}"
                           class="px-4 py-2 bg-blue-500 text-white text-sm rounded-full hover:bg-blue-600 transition-colors"
                           onclick="event.stopPropagation();">
                            Edit
                        </a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-4 py-2 bg-red-500 text-white text-sm rounded-full hover:bg-red-600 transition-colors"
                                    onclick="event.stopPropagation() && confirm('Are you sure you want to delete this task?')">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500 dark:text-gray-400 text-lg">
                        No tasks yet. Start by creating one!
                    </p>
                </div>
            @endforelse
        </div>
    </main>
@endsection
