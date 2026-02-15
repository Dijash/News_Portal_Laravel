<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
        public function login()
        {
            return view('auth.loginPage');
        }
        public function authenticate(Request $request)
        {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            if (auth()->attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended(route('admin.dashboard'));
            }

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
        public function logout(Request $request)
        {
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('home');
        }
        public function register()
        {
            return view('auth.register');
        }
        
        public function storeRegister(Request $request)
        {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            Auth::login($user);

            return redirect()->route('admin.dashboard')->with('success', 'Registration successful!');
        }
}
