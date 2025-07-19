<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Assuming you have a User model
use App\Models\Proyek; // Assuming you have a Proyek model

class AuthController extends Controller
{
  
    public function login()

    {
        $data = [
            'title' => 'Login',
            'description' => 'Please enter your credentials to log in.',
        ];
        // You can pass data to the view if neededWW
        return view('loreg', $data);
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required|min:5',
            'password' => 'required|min:8',
        ],
        [
            'username.required' => 'Username Harus Diisi!.',
            'username.min' => 'Username Minimal 5 Karakter.',
            'password.required' => 'Password Harus Diisi!.',
            'password.min' => 'Password Minimal 8 karakter.',
        ]);

        // Logic for authenticating the user
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            // Cek role user
            if ($user->role === 'admin' && $user->status === 'active') {
            return redirect()->route('dashboard-admin')->with('success', 'Anda telah berhasil login sebagai Admin.');
            } elseif ($user->role === 'pengawas' && $user->status === 'active') {
            return redirect()->route('dashboard-pengawas')->with('success', 'Anda telah berhasil login sebagai Pengawas.');
            } elseif ($user->role === 'tender' && $user->status === 'active') {
                // Redirect to the tender dashboard
            return redirect()->route('dashboard-tender')->with('success', 'Anda telah berhasil login sebagai Tender.');
            } else {
                return redirect()->route('login')->with(
                    'error', 'Akun Anda tidak aktif. Silakan hubungi admin.'
                );
            }
        }

        return back()->with(
            'error', 'Username atau Password salah.'
        );
    }
    
    public function register(request $request)
    {
        // Validasi input
    $request->validate([
        'name' => 'required|min:3',
        'username' => 'required|min:5|unique:users,username',
        'email' => 'required|email|unique:users,email',
        'whatsapp' => 'required|min:10|unique:users,whatsapp',
        'file_path' => 'required|file|mimes:pdf|max:2048',
    ], [
        'name.required' => 'Nama harus diisi!',
        'username.required' => 'Username harus diisi!',
        'username.min' => 'Username minimal 5 karakter.',
        'username.unique' => 'Username sudah terdaftar.',
        'email.required' => 'Email harus diisi!',
        'email.email' => 'Format email tidak valid.',
        'email.unique' => 'Email sudah terdaftar.',
        'whatsapp.required' => 'Nomor WhatsApp harus diisi!',
        'whatsapp.min' => 'Nomor WhatsApp minimal 10 karakter.',
        'whatsapp.unique' => 'Nomor WhatsApp sudah digunakan!',
        'file_path.required' => 'File harus diunggah!',
        'file_path.file' => 'File harus berupa dokumen.',
        'file_path.mimes' => 'File harus berformat PDF.',
        'file_path.max' => 'Ukuran file maksimal 2MB.',
    ]);

    // Simpan file
    $filePath = $request->file('file_path')->store('uploads', 'public');

    // Buat user baru
    $user = User::create([
        'name' => $request->name,
        'username' => $request->username,
        'email' => $request->email,
        'whatsapp' => $request->whatsapp,
        'file_path' => $filePath,
        'password' => Hash::make($request->whatsapp), // Password default bisa disesuaikan
    ]);


    // Redirect ke halaman login dengan pesan sukses
    return redirect()->back()->with('success', 'Registrasi berhasil! Sedang Dalam Peoses Verifikasi.');
        

    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Anda telah berhasil logout.');
    }
    public function index()
    {
        // Redirect to the main view
        $data = [
            'title' => 'Home',
            'description' => 'Selamat datang di halaman utama.',
            'proyek' => Proyek::all(), // Assuming you want to show all projects on the main page
        ];
        return view('utama', $data);
    }
}
