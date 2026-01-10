<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // --- 1. MENAMPILKAN FORM LOGIN ---
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // --- 2. PROSES LOGIN ---
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Jika berhasil, arahkan ke dashboard
            return redirect()->intended('dashboard')->with('success', 'Selamat datang kembali! 👋');
        }

        // Jika gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // --- 3. MENAMPILKAN FORM REGISTER ---
    // GANTI 'showRegistrationForm' MENJADI 'showRegister'
    public function showRegister()
    {
        return view('auth.register');
    }
    // --- 4. PROSES REGISTER ---
    public function register(Request $request)
    {
        // Validasi
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // Pastikan ada input password_confirmation di view
        ]);

        // Buat User Baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'member',
        ]);

        // Langsung login setelah daftar
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Akun berhasil dibuat! 🎉');
    }

    // --- 5. PROSES LOGOUT ---
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}