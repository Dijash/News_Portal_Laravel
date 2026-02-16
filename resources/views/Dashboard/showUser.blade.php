@extends('Layouts.adminApp')

@section('adminContent')
<main class="flex-1 px-4 sm:px-6 py-6 sm:py-8">
    <div class="max-w-3xl mx-auto bg-white dark:bg-gray-900 rounded-xl shadow p-6 sm:p-8">

        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mb-6">
            <h2 class="text-2xl font-bold">User Details</h2>
            <a href="{{ route('admin.manageUsers') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                Back to Users
            </a>
        </div>

        <div class="space-y-4">
            <!-- User ID -->
            <div class="border-b pb-4">
                <label class="block text-sm font-medium text-gray-500 mb-1">User ID</label>
                <p class="text-lg">{{ $user->id }}</p>
            </div>

            <!-- Name -->
            <div class="border-b pb-4">
                <label class="block text-sm font-medium text-gray-500 mb-1">Name</label>
                <p class="text-lg">{{ $user->name }}</p>
            </div>

            <!-- Email -->
            <div class="border-b pb-4">
                <label class="block text-sm font-medium text-gray-500 mb-1">Email</label>
                <p class="text-lg">{{ $user->email }}</p>
            </div>

            <!-- Role -->
            <div class="border-b pb-4">
                <label class="block text-sm font-medium text-gray-500 mb-1">Role</label>
                <span class="inline-block px-3 py-2 {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800' }} rounded-full text-sm font-semibold">
                    {{ ucfirst($user->role ?? 'User') }}
                </span>
            </div>

            <!-- Created At -->
            <div class="border-b pb-4">
                <label class="block text-sm font-medium text-gray-500 mb-1">Registered On</label>
                <p class="text-lg">{{ $user->created_at->format('F d, Y h:i A') }}</p>
            </div>

            <!-- Updated At -->
            <div class="border-b pb-4">
                <label class="block text-sm font-medium text-gray-500 mb-1">Last Updated</label>
                <p class="text-lg">{{ $user->updated_at->format('F d, Y h:i A') }}</p>
            </div>

            <!-- Email Verified -->
            <div class="border-b pb-4">
                <label class="block text-sm font-medium text-gray-500 mb-1">Email Verification</label>
                @if($user->email_verified_at)
                    <span class="inline-block px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">
                        Verified on {{ $user->email_verified_at->format('F d, Y') }}
                    </span>
                @else
                    <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">
                        Not Verified
                    </span>
                @endif
            </div>

            <!-- Actions -->
            <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4">
                @if($user->id !== Auth::id())
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                            Delete User
                        </button>
                    </form>
                @else
                    <p class="text-sm text-gray-500 italic">You cannot delete your own account</p>
                @endif
            </div>
        </div>

    </div>
</main>
@endsection
