<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan masuk.');
    }

    /**
     * Display the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();
        if ($user) {
            if (Auth::attempt($credentials)) {
                return redirect()->route('dashboard')->with('success', 'Login berhasil.');
            } else {
                return back()->withErrors([
                    'password' => 'Kata sandi salah, silakan coba lagi.',
                ]);
            }
        }
        return back()->withErrors([
            'email' => 'Email belum terdaftar. Lakukan registrasi terlebih dahulu.',
        ]);
    }

    /**
     * Handle user logout.
     */
    public function logout()
    {
        Auth::logout(); // Logout pengguna
        return redirect()->route('login')->with('success', 'Logout successful.');
    }
}
