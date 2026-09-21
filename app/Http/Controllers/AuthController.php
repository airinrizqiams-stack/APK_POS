<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Menampilkan Halaman Login
    public function login()
    {
        return view('auth.login'); // Sesuaikan 'auth.login' dengan lokasi file blade Anda
    }

    // Memproses Aksi Login
    public function auth(Request $request)
    {
        $throttleKey = 'login_attempt_' . $request->ip();

        // 1. Jika sudah mencapai batas (>= 3 kali salah), Kunci Akses
        if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->withInput()->with('error_lockout_seconds', $seconds);
        }

        // 2. Validasi Form
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();

        // Cek Keberadaan User & Password
        $isEmailValid = $user ? true : false;
        $isPasswordValid = $user && Hash::check($password, $user->password);

        // JIKA LOGIN GAGAL
        if (!$isEmailValid || !$isPasswordValid) {
            RateLimiter::hit($throttleKey, 60);

            if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
                $seconds = RateLimiter::availableIn($throttleKey);
                return back()->withInput()->with('error_lockout_seconds', $seconds);
            }

            $attemptsLeft = RateLimiter::remaining($throttleKey, 3);

            if (!$isEmailValid) {
                return back()->withInput()->with([
                    'error_type' => 'both_invalid',
                    'error_title' => 'Email & Kata Sandi Tidak Ditemukan!',
                    'error_message' => 'Alamat email dan kata sandi yang Anda masukkan tidak terdaftar dalam sistem.',
                    'attempts_left' => $attemptsLeft
                ]);
            } else {
                return back()->withInput()->with([
                    'error_type' => 'password_invalid',
                    'error_title' => 'Kata Sandi Salah!',
                    'error_message' => 'Kata sandi yang Anda masukkan tidak sesuai dengan email ini.',
                    'attempts_left' => $attemptsLeft
                ]);
            }
        }

        // JIKA LOGIN BERHASIL
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $request->session()->regenerate();
            RateLimiter::clear($throttleKey);

            return redirect()->route('dashboard')->with('success', 'Selamat Datang, ' . Auth::user()->name);
        }
    }
}