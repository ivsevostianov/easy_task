<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="min-h-screen bg-gray-900 text-gray-200 antialiased relative">
    <!-- Background pattern -->
    <div class="fixed inset-0 pointer-events-none">
        <div class="absolute inset-0 opacity-30"
             style="background-image: radial-gradient(#1F2937 1px, transparent 1px);
                        background-size: 32px 32px;">
        </div>
    </div>

    <div class="min-h-screen flex flex-col items-center justify-center p-4 relative z-10">
        <!-- Logo -->
        <div class="w-16 h-16 mb-8 relative">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full blur-lg animate-pulse"></div>
            <div class="relative bg-gray-900 p-3 rounded-lg border border-gray-700">
                <svg class="w-full h-full text-blue-500" viewBox="0 0 24 24" fill="none">
                    <path d="M21 9V3H15M21 3L12 12M10 3H7.8C6.12 3 5.28 3 4.638 3.327C4.074 3.615 3.615 4.074 3.327 4.638C3 5.28 3 6.12 3 7.8V16.2C3 17.88 3 18.72 3.327 19.362C3.615 19.926 4.074 20.385 4.638 20.673C5.28 21 6.12 21 7.8 21H16.2C17.88 21 18.72 21 19.362 20.673C19.926 20.385 20.385 19.926 20.673 19.362C21 18.72 21 17.88 21 16.2V14"
                          stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>

        <div class="w-full max-w-md relative">
            <!-- Main card -->
            <div class="backdrop-blur-xl bg-gray-800/30 border border-gray-700 rounded-2xl p-8 shadow-2xl relative">
                <!-- Gradient overlay -->
                <div class="absolute inset-0 rounded-2xl bg-gradient-to-b from-blue-500/5 to-purple-500/5 pointer-events-none"></div>

                <!-- Content -->
                <div class="relative z-10">
                    <!-- Header -->
                    <div class="text-center mb-8">
                        <h1 class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-purple-400">
                            Welcome Back 🚀
                        </h1>
                        <p class="mt-2 text-gray-400">Please sign in to continue</p>
                    </div>

                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="mb-4 text-sm text-green-400">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Login Form -->
                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                            <input type="email"
                                   name="email"
                                   id="email"
                                   value="{{ old('email') }}"
                                   required
                                   autofocus
                                   class="w-full px-4 py-2 bg-gray-900/50 border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 placeholder-gray-500 text-white"
                                   placeholder="you@example.com">
                            @error('email')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Password</label>
                            <input type="password"
                                   name="password"
                                   id="password"
                                   required
                                   class="w-full px-4 py-2 bg-gray-900/50 border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-white"
                                   placeholder="••••••••">
                            @error('password')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center">
                            <input type="checkbox"
                                   name="remember"
                                   id="remember"
                                   class="rounded border-gray-600 bg-gray-900/50 text-blue-500 focus:ring-blue-500">
                            <label for="remember" class="ml-2 text-sm text-gray-400">
                                Remember me
                            </label>
                        </div>

                        <!-- Form actions -->
                        <div class="flex items-center justify-between pt-4">
                            <div class="flex flex-col space-y-2">
                                <a href="{{ route('register') }}"
                                   class="text-sm text-gray-400 hover:text-blue-400 transition-colors duration-200">
                                    Need an account?
                                </a>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}"
                                       class="text-sm text-gray-400 hover:text-blue-400 transition-colors duration-200">
                                        Forgot password?
                                    </a>
                                @endif
                            </div>
                            <button type="submit"
                                    class="px-6 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-medium rounded-lg hover:from-blue-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-900 transition-all duration-200 transform hover:scale-105">
                                Sign In
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Decorative elements -->
            <div class="absolute -top-4 -right-4 w-24 h-24 bg-blue-500 rounded-full mix-blend-multiply filter blur-xl opacity-10 animate-blob pointer-events-none"></div>
            <div class="absolute -bottom-8 -left-4 w-24 h-24 bg-purple-500 rounded-full mix-blend-multiply filter blur-xl opacity-10 animate-blob animation-delay-2000 pointer-events-none"></div>
        </div>
    </div>
</div>

<style>
    @keyframes blob {
        0% { transform: translate(0px, 0px) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
        100% { transform: translate(0px, 0px) scale(1); }
    }
    .animate-blob {
        animation: blob 7s infinite;
    }
    .animation-delay-2000 {
        animation-delay: 2s;
    }
</style>
</body>
</html>
