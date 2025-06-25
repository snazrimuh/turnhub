<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // Tampilkan halaman login
    public function showLoginForm()
    {
        // Cek jika admin sudah login
        if (session()->has('admin_id')) {
            return redirect()->route('admin.dashboard'); // Langsung ke dashboard jika sudah login
        }

        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Cek apakah admin ada di database
        $admin = Admin::where('email', $request->email)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            // Jika cocok, simpan session login
            session(['admin_id' => $admin->id]);

            return redirect()->route('admin.dashboard');
        } else {
            // Jika gagal login
            return back()->withErrors(['email' => 'Invalid email or password.']);
        }
    }

    // Halaman dashboard admin
    public function dashboard()
    {
        // Pastikan hanya yang sudah login yang bisa mengakses dashboard
        if (!session()->has('admin_id')) {
            return redirect()->route('login.form');
        }

        return view('admin.dashboard');
    }

    // Logout
    public function logout()
    {
        session()->forget('admin_id');
        return redirect()->route('login.form');
    }
}
