@extends('Layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-100">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Welcome Back</h1>
                <p class="text-gray-600 mt-2">Sign in to your account</p>
            </div>

            <!-- Flash Messages -->
            @if(session('error'))
                <div class="mb-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            @if(session('success'))
                <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="you@example.com">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" required
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        placeholder="••••••••">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center mb-6">
                    <input type="checkbox" id="remember" name="remember"
                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="remember" class="ml-2 text-sm text-gray-600">Remember me</label>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 rounded-lg transition">
                    Sign In
                </button>
            </form>

            <!-- Footer -->
            <div class="mt-6 text-center text-sm text-gray-600">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-indigo-600 hover:underline font-medium">Sign up</a>
            </div>
        </div>
    </div>
</div>
@endsection