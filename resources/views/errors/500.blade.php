@extends('layouts.app')

@section('title', '500 - Server Error')

@section('content')
    <div class="min-h-screen flex flex-col items-center justify-center bg-white dark:bg-gray-900">
        <h1 class="text-6xl font-extrabold text-gray-900 dark:text-gray-100 mb-4">500</h1>
        <p class="text-xl text-gray-600 dark:text-gray-400 mb-8">
            Whoops! Something went wrong on our end.
        </p>
        <a href="{{ url('/') }}"
           class="px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-medium rounded-full hover:from-blue-600 hover:to-purple-700 transition-all duration-200 transform hover:scale-105">
            Return Home
        </a>
    </div>
@endsection
