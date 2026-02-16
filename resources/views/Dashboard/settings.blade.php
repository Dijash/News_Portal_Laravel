@extends('Layouts.adminApp')

@section('adminContent')
<main class="flex-1 px-4 sm:px-6 py-8 sm:py-10 bg-gray-50 dark:bg-gray-950 min-h-screen">

    <div class="max-w-5xl mx-auto space-y-8">

        <!-- Header -->
        <header>
            <h1 class="text-3xl font-bold bg-linear-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                Account Settings
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Manage your profile information and security settings
            </p>
        </header>

        <!-- Success Message -->
        @if (session('success'))
        <div class="flex items-center gap-3 p-4 bg-green-100 border border-green-300 text-green-800 rounded-xl shadow-sm">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
        @endif


        <!-- ================= CURRENT DETAILS ================= -->
        <section class="settings-card">
            <div class="settings-header">
                <h2>Current Details</h2>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <p class="label">Name</p>
                    <p class="value">{{ Auth::user()->name }}</p>
                </div>

                <div>
                    <p class="label">Email</p>
                    <p class="value">{{ Auth::user()->email }}</p>
                </div>
            </div>
        </section>


        <!-- ================= PROFILE UPDATE ================= -->
        <section class="settings-card">
            <div class="settings-header">
                <h2>Update Profile</h2>
                <p>Edit your personal information</p>
            </div>

            <form action="{{ route('admin.settings.profile') }}" method="POST" class="space-y-6">
                @csrf
                @method('PATCH')

                <div class="input-group">
                    <label>Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name"
                        value="{{ old('name', Auth::user()->name) }}"
                        class="input-field @error('name') border-red-500 @enderror"
                        required
                        minlength="2"
                        maxlength="255">
                    @error('name')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="input-group">
                    <label>Email <span class="text-red-500">*</span></label>
                    <input type="email" name="email"
                        value="{{ old('email', Auth::user()->email) }}"
                        class="input-field @error('email') border-red-500 @enderror"
                        required>
                    @error('email')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn-primary">
                    <i class="fas fa-user-edit"></i>
                    Update Profile
                </button>
            </form>
        </section>


        <!-- ================= PASSWORD ================= -->
        <section class="settings-card">
            <div class="settings-header">
                <h2>Change Password</h2>
                <p>Keep your account secure</p>
            </div>

            <form action="{{ route('admin.settings.password') }}" method="POST" class="space-y-6">
                @csrf
                @method('PATCH')

                <div class="input-group">
                    <label>Current Password <span class="text-red-500">*</span></label>
                    <input type="password" name="current_password" 
                        class="input-field @error('current_password') border-red-500 @enderror"
                        required
                        minlength="8">
                    @error('current_password')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="input-group">
                    <label>New Password <span class="text-red-500">*</span></label>
                    <input type="password" name="password" 
                        class="input-field @error('password') border-red-500 @enderror"
                        required
                        minlength="8"
                        id="new_password">
                    @error('password')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="input-group">
                    <label>Confirm Password <span class="text-red-500">*</span></label>
                    <input type="password" name="password_confirmation" 
                        class="input-field @error('password_confirmation') border-red-500 @enderror"
                        required
                        minlength="8">
                </div>

                <button type="submit" class="btn-purple">
                    <i class="fas fa-lock"></i>
                    Update Password
                </button>
            </form>
        </section>

    </div>
</main>


<style>

/* ================= CARDS ================= */
.settings-card {
    background: transparent;
    border-radius: 16px;
    border: 1px solid white;
    padding: 30px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    transition: 0.3s;
}

.dark .settings-card {
    background: #0f172a;
}

.settings-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.08);
}

/* ================= HEADERS ================= */
.settings-header h2 {
    font-size: 20px;
    font-weight: 600;
}

.settings-header p {
    font-size: 13px;
    color: #888;
    margin-top: 4px;
    margin-bottom: 20px;
}

/* ================= TEXT ================= */
.label {
    font-size: 13px;
    color: #888;
}

.value {
    font-size: 18px;
    font-weight: 600;
}

/* ================= INPUTS ================= */
.input-group label {
    display: block;
    font-size: 14px;
    font-weight: 500;
    margin-bottom: 6px;
}

.input-field {
    width: 100%;
    color: #0f172a;
    border-radius: 10px;
    border: 1px solid #e2e8f0;
    padding: 10px 14px;
    transition: 0.2s;
}

.input-field:focus {
    outline: none;
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99,102,241,0.15);
}

/* ================= BUTTONS ================= */
.btn-primary {
    background: linear-gradient(45deg,#2563eb,#4f46e5);
    color: white;
    padding: 12px 22px;
    border-radius: 12px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-weight: 500;
    transition: 0.3s;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(37,99,235,0.3);
}

.btn-purple {
    background: linear-gradient(45deg,#9333ea,#6d28d9);
    color: white;
    padding: 12px 22px;
    border-radius: 12px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-weight: 500;
    transition: 0.3s;
}

.btn-purple:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(147,51,234,0.3);
}

@media (max-width: 640px) {
    .settings-card {
        padding: 20px;
    }

    .btn-primary,
    .btn-purple {
        width: 100%;
        justify-content: center;
    }
}

/* ================= ERRORS ================= */
.error {
    color: #ef4444;
    font-size: 13px;
    margin-top: 6px;
}

</style>

@endsection