<!-- resources/views/auth/register.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register</title>
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
                            Create Account
                        </h1>
                        <p class="mt-2 text-gray-400">Let's get you started with your account</p>
                    </div>

                    <!-- Registration Form -->
                    <form id="registerForm" method="POST" action="{{ route('register') }}" class="space-y-6">
                        @csrf

                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Name</label>
                            <input type="text"
                                   name="name"
                                   id="name"
                                   value="{{ old('name') }}"
                                   required
                                   autofocus
                                   class="w-full px-4 py-2 bg-gray-900/50 border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 placeholder-gray-500 text-white"
                                   placeholder="Your name">
                            @error('name')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                            <p id="clientNameError" class="mt-1 text-sm text-red-400 hidden">
                                Name must be at least 3 characters long and contain only letters.
                            </p>
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                            <input type="email"
                                   name="email"
                                   id="email"
                                   value="{{ old('email') }}"
                                   required
                                   class="w-full px-4 py-2 bg-gray-900/50 border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 placeholder-gray-500 text-white"
                                   placeholder="you@example.com">
                            @error('email')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                            <p id="clientEmailError" class="mt-1 text-sm text-red-400 hidden">
                                Please enter a valid email address.
                            </p>
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
                            <p id="clientPasswordLengthError" class="mt-1 text-sm text-red-400 hidden">
                                Password must be at least 8 characters long.
                            </p>
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-1">
                                Confirm Password
                            </label>
                            <input type="password"
                                   name="password_confirmation"
                                   id="password_confirmation"
                                   required
                                   class="w-full px-4 py-2 bg-gray-900/50 border border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-white"
                                   placeholder="••••••••">
                            <p id="clientPasswordError" class="mt-1 text-sm text-red-400 hidden">
                                Passwords do not match.
                            </p>
                        </div>

                        <!-- Form actions -->
                        <div class="flex items-center justify-between pt-4">
                            <a href="{{ route('login') }}"
                               class="text-sm text-gray-400 hover:text-blue-400 transition-colors duration-200">
                                Already registered?
                            </a>
                            <button id="registerButton" type="submit" disabled
                                    class="px-6 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-medium rounded-lg opacity-50 cursor-not-allowed focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-900 transition-all duration-200 transform hover:scale-105">
                                Register
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

<script>
    // Flag variables to track whether the user has interacted with each field
    let nameTouched = false;
    let emailTouched = false;
    let passwordTouched = false;
    let confirmPasswordTouched = false;

    // Get references to the form elements
    const registerForm = document.getElementById('registerForm');
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const passwordConfirmInput = document.getElementById('password_confirmation');
    const registerButton = document.getElementById('registerButton');

    // Get references to client-side error elements
    const clientNameError = document.getElementById('clientNameError');
    const clientEmailError = document.getElementById('clientEmailError');
    const clientPasswordLengthError = document.getElementById('clientPasswordLengthError');
    const clientPasswordError = document.getElementById('clientPasswordError');

    // Validation functions
    function validateName() {
        const nameValue = nameInput.value.trim();
        const nameRegex = /^(?=.{3,}$)[A-Za-z]+(?:\s[A-Za-z]+)*$/
        ; // At least 3 letters
        const valid = nameRegex.test(nameValue);
        // Only show the error if the field has been touched
        if (nameTouched) {
            clientNameError.classList.toggle('hidden', valid);
        }
        return valid;
    }

    function validateEmail() {
        const emailValue = emailInput.value.trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const valid = emailRegex.test(emailValue);
        if (emailTouched) {
            clientEmailError.classList.toggle('hidden', valid);
        }
        return valid;
    }

    function validatePasswordLength() {
        const valid = passwordInput.value.length >= 8;
        if (passwordTouched) {
            clientPasswordLengthError.classList.toggle('hidden', valid);
        }
        return valid;
    }

    function validatePasswordMatch() {
        const valid = passwordInput.value === passwordConfirmInput.value && passwordInput.value.length > 0;
        if (confirmPasswordTouched) {
            clientPasswordError.classList.toggle('hidden', valid);
        }
        return valid;
    }

    // Master validation function to update the button state
    function validateForm() {
        const isNameValid = validateName();
        const isEmailValid = validateEmail();
        const isPasswordLengthValid = validatePasswordLength();
        const isPasswordMatch = validatePasswordMatch();

        if (isNameValid && isEmailValid && isPasswordLengthValid && isPasswordMatch) {
            registerButton.disabled = false;
            registerButton.classList.remove('opacity-50', 'cursor-not-allowed');
        } else {
            registerButton.disabled = true;
            if (!registerButton.classList.contains('opacity-50')) {
                registerButton.classList.add('opacity-50', 'cursor-not-allowed');
            }
        }
        return isNameValid && isEmailValid && isPasswordLengthValid && isPasswordMatch;
    }

    // Attach event listeners for each field so that its error shows only once touched
    nameInput.addEventListener('input', () => {
        nameTouched = true;
        validateName();
        validateForm();
    });

    emailInput.addEventListener('input', () => {
        emailTouched = true;
        validateEmail();
        validateForm();
    });

    passwordInput.addEventListener('input', () => {
        passwordTouched = true;
        validatePasswordLength();
        // Also update password match if confirm field is already touched
        if (confirmPasswordTouched) {
            validatePasswordMatch();
        }
        validateForm();
    });

    passwordConfirmInput.addEventListener('input', () => {
        confirmPasswordTouched = true;
        validatePasswordMatch();
        validateForm();
    });

    // Optionally, prevent form submission if validations fail
    registerForm.addEventListener('submit', (event) => {
        if (!validateForm()) {
            event.preventDefault();
        }
    });
</script>

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
