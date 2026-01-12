<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    // Tampilkan halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect('/admin/dashboard');
            } else {
                return redirect('/');
            }
        }

        return back()->with('error', 'Email atau password salah.');
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    // Tampilkan halaman register
    public function showRegister()
    {
        return view('auth.register');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required', 'regex:/^[A-Za-z\s]+$/',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
    public function forgotPassword()
{
    return view('auth.forgot-password');
}

public function sendResetLink(Request $request)
{
    $request->validate([
        'email' => 'required|email'
    ]);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with('status', 'Link reset password sudah dikirim ke email')
        : back()->withErrors(['email' => 'Email tidak ditemukan']);
}

public function resetPassword($token)
{
    return view('auth.reset-password', ['token' => $token]);
}

public function updatePassword(Request $request)
{
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:6|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->password = Hash::make($password);
            $user->save();
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect('/login')->with('success', 'Password berhasil diubah')
        : back()->withErrors(['email' => 'Token tidak valid atau email salah']);
}

}
