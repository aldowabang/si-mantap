<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Models\User; // Assuming you have a User model
use App\Models\Proyek; // Assuming you have a Proyek model
use App\Models\Monitoring; // Assuming you have a Monitoring model
use App\Models\Tahap; // Assuming you have a Tahap model
use App\Models\Dokument; // Assuming you have a Dokument model



class AdminController extends Controller
{
    
    public function index()
    {
        $data = [
            'title' => 'dashboard',
            'description' => 'Halaman Admin',
            'data' => User::all(),
            'proyek' => Proyek::all(),
            'activeUsers' => User::where('status', 'active')->count(),
            'nonActiveUsers' => User::where('status', 'non-active')->count(),
            'totalUsers' => User::count(),
            'totalProyek' => Proyek::count(),
            'totalPengawas' => User::where('role', 'pengawas')->count(),
            'totalTender' => User::where('role', 'tender')->count(),    

        ];
        return view('admin.index', $data);
    }
    public function show()
    {
        $data = [
            'title' => 'Users',
            'description' => 'Halaman Users',
            'data' => User::all(),
        ];
        return view('admin.show', $data);
    }

    public function view($id)
    {
        $user = User::findOrFail($id);
        $data = [
            'title' => 'View User',
            'description' => 'Halaman View User',
            'user' => $user,
        ];
        return view('admin.view-user', $data);
    }


    public function activeUser($id)
    {
        $user = User::findOrFail($id);

        if ($user->status === 'active') {
            $user->status = 'non-active';
        } else {
            $user->status = 'active'; // Set status to active
            // Send WhatsApp notification
            $this->sendWhatsAppNotification($user);
            
            
            
            $message = "Akun Anda telah aktif.\n\n" .
                    "Username: {$user->email}\n" .
                    "Password: {$user->whatsapp}\n\n" .
                    "Silakan gunakan untuk login ke sistem.";

            Mail::raw($message, function ($mail) use ($user) {
                $mail->to($user->email)
                    ->subject('Akun Anda Sudah Aktif');
            });
        }

        $user->save();


        return redirect()->route('admin-show')->with('success', 'User status update Berhasil.');
    }

    private function sendWhatsAppNotification($user)
    {
        $apiKey = env('FONNTE_API_KEY');
        $message = "Akun Anda telah aktif.\n\n" .
                "Username dan password telah dikirim ke: {$user->email}\n" .
                "Silakan cek di email tersebut.";

        // Kirim pesan WhatsApp
        $response = Http::withHeaders([
            'Authorization' => $apiKey,
            'Content-Type' => 'application/json',
        ])->post('https://api.fonnte.com/send', [
            'target' => $user->whatsapp, 
            'message' => $message,
            'countryCode' => "62",
        ]);

        // Kirim file PDF jika ada
        if ($user->file_path) {
            $pdfPath = storage_path('app/public/' . $user->file_path);
            if (file_exists($pdfPath)) {
            Http::withHeaders([
                'Authorization' => $apiKey,
                'Content-Type' => 'application/json',
            ])->attach(
                'file', file_get_contents($pdfPath), basename($pdfPath)
            )->post('https://api.fonnte.com/send', [
                'target' => $user->whatsapp,
                'countryCode' => "62",
            ]);
            }
        }
        
    }

    public function add()
    {
        $data = [
            'title' => 'Add User',
            'description' => 'Halaman Tambah User',
        ];
        return view('admin.add-user', $data);
    }
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|min:3',
            'username' => 'required|min:5|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'whatsapp' => 'required|min:10|unique:users,whatsapp',
            'role' => 'required|in:admin,pengawas,tender',
        ], [
            'name.required' => 'Nama harus diisi.',
            'username.required' => 'Username harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan oleh user lain.',
            'whatsapp.required' => 'Nomor WhatsApp harus diisi.',
            'role.required' => 'Role harus dipilih.',
            'username.min' => 'Username minimal 5 karakter.',
            'whatsapp.min' => 'Nomor WhatsApp minimal 10 karakter.',
            'username.unique' => 'Username sudah digunakan oleh user lain.',
            'whatsapp.unique' => 'Nomor WhatsApp sudah digunakan oleh user lain.',
            'role.in' => 'Role harus salah satu dari: admin, pengawas, tender.',
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'whatsapp' => $request->whatsapp,
            'role' => $request->role,
            'password' => bcrypt($request->whatsapp), // Password default bisa disesuaikan
        ]);

        
        // Handle file upload
        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $path = $file->store('uploads', 'public');
            $user->file_path = $path;
        }
        $user->save();
        // Kirim notifikasi WhatsApp
        $this->sendWhatsAppNotificationadd($user);
        // Kirim email notifikasi
        $message = "Akun Anda telah dibuat.\n\n" .
                "Username: {$user->email}\n" .
                "Password: {$user->whatsapp}\n\n" .
                "Role: {$user->role}\n\n" .
                "Hubungi Admin untuk mengaktifkan akun Anda.\n" .
                "Silakan gunakan untuk login ke sistem.";
        Mail::raw($message, function ($mail) use ($user) {
            $mail->to($user->email)
                ->subject('Akun Anda Telah Dibuat');
        });
        return redirect()->route('admin-show')->with('success', 'User created successfully.');
    }

    private function sendWhatsAppNotificationadd($user)
    {
        $apiKey = env('FONNTE_API_KEY');
        $message = "Hallo : {$user->name}" .
                "Akun Anda telah dibuat.\n\n" .
                "Username: {$user->email}\n" .
                "Password: {$user->whatsapp}\n\n" .
                "Role: {$user->role}\n\n" .
                "Hubungi Admin untuk mengaktifkan akun Anda.\n" .
                "Silakan gunakan untuk login ke sistem.";

        // Kirim pesan WhatsApp
        $response = Http::withHeaders([
            'Authorization' => $apiKey,
            'Content-Type' => 'application/json',
        ])->post('https://api.fonnte.com/send', [
            'target' => $user->whatsapp, 
            'message' => $message,
            'countryCode' => "62",
        ]);

        
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        $data = [
            'title' => 'Edit User',
            'description' => 'Halaman Edit User',
            'user' => $user,
        ];
        return view('admin.edit-user', $data);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->whatsapp = $request->input('whatsapp');
        $user->role = $request->input('role');

        if (User::where('email', $request->input('email'))->where('id', '!=', $id)->exists()) {
            return redirect()->back()->with('error', 'Email sudah digunakan oleh user lain.')->withInput();
        }
        if (User::where('username', $request->input('username'))->where('id', '!=', $id)->exists()) {
            return redirect()->back()->with('error', 'Username sudah digunakan oleh user lain.')->withInput();
        }
        if (User::where('whatsapp', $request->input('whatsapp'))->where('id', '!=', $id)->exists()) {
            return redirect()->back()->with('error', 'Nomor WhatsApp sudah digunakan oleh user lain.')->withInput();
        }
        // Handle file upload
        
        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $path = $file->store('uploads', 'public');
            $user->file_path = $path;
        }

        $user->save();

        return redirect()->route('admin-show')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin-show')->with('success', 'User deleted successfully.');
    }

    // proyek management
    public function proyek()
    {
        $data = [
            'title' => 'Proyek',
            'description' => 'Halaman Proyek',
            'data' => Proyek::with('user')->get(), // Assuming you want to show all projects with user information
        ];
        return view('admin.proyek', $data);
    }

    public function addProyek()
    {   
        
        $data = [
            'title' => 'Add Proyek',
            'description' => 'Halaman Tambah Proyek',
            'users' => User::where('role', 'pengawas')->get(), // Assuming you want to show only pengawas users
            
        ];
        return view('admin.proyek.add-proyek', $data);
    }

    public function storeProyek(Request $request)
    {
        $request->validate([
            'nameProyek' => 'required|min:3',
            'lokasi' => 'required|min:3',
            'jenis' => 'required|min:3',
            'nilai' => 'required|numeric',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'file_path' => 'required|file|mimes:pdf|max:2048',
            'user_id' => 'required|exists:users,id',
        ], [
            'nameProyek.required' => 'Nama Proyek harus diisi.',
            'lokasi.required' => 'Lokasi harus diisi.',
            'jenis.required' => 'Jenis harus diisi.',
            'nilai.required' => 'Nilai harus diisi.',
            'gambar.required' => 'Gambar harus diunggah.',
            'file_path.required' => 'File harus diunggah.',
            'user_id.required' => 'Pengawas harus dipilih.',
            'user_id.exists' => 'Pengawas yang dipilih tidak valid.',
        ]);

        $proyek = new Proyek();
        $proyek->user_id = $request->input('user_id');
        $proyek->nameProyek = $request->input('nameProyek');
        $proyek->lokasi = $request->input('lokasi');
        $proyek->jenis = $request->input('jenis');
        $proyek->nilai = $request->input('nilai');
        $proyek->status = $request->input('status');
        $proyek->deskripsi = $request->input('deskripsi');
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $gambarPath = $gambar->store('uploads/gambar', 'public');
            $proyek->gambar = $gambarPath;
        }
        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $filePath = $file->store('uploads/files', 'public');
            $proyek->file_path = $filePath;
        }
        $proyek->save();

        // Tambah tahapan default secara efisien
        Tahap::create([
            'proyek_id' => $proyek->id,
            'namaTahap' => 'Tahap 1 - ' . $proyek->nameProyek,
            'statusTahap' => 'non-approval',
        ]);
        return redirect()->route('admin-proyek')->with('success', 'Proyek created successfully.');

    }

    public function viewProyek($id)
    {
        $proyek = Proyek::all()->where('id', $id)->firstOrFail();
        $data = [
            'title' => 'View Proyek',
            'description' => 'Halaman View Proyek',
            'proyek' => $proyek,
        ];
        return view('admin.proyek.view-proyek', $data);
    }

    public function editProyek($id)
    {
        $proyek = Proyek::where('id', $id)->with('user')->firstOrFail();
        $data = [
            'title' => 'Edit Proyek',
            'description' => 'Halaman Edit Proyek',
            'proyek' => $proyek,
            'users' => User::where('role', 'pengawas')->get(), // Assuming you want to show only pengawas users
        ];
        return view('admin.proyek.edit-proyek', $data);
    }

    public function updateProyek(Request $request, $id)
    {
        $proyek = Proyek::where('id', $id)->with('user')->firstOrFail();
        $proyek->nameProyek = $request->input('nameProyek');
        $proyek->lokasi = $request->input('lokasi');
        $proyek->jenis = $request->input('jenis');
        $proyek->nilai = $request->input('nilai');
        $proyek->status = $request->input('status');
        $proyek->deskripsi = $request->input('deskripsi');

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $gambarPath = $gambar->store('uploads/gambar', 'public');
            $proyek->gambar = $gambarPath;
        }
        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $filePath = $file->store('uploads/files', 'public');
            $proyek->file_path = $filePath;
        }
        
        // Handle user_id update
        if ($request->has('user_id')) {
            $proyek->user_id = $request->input('user_id');
        }

        $proyek->save();
        return redirect()->route('admin-proyek')->with('success', 'Proyek updated successfully.');
    }
    public function deleteProyek($id)
    {
        $proyek = Proyek::findOrFail($id);
        $proyek->delete();
        return redirect()->route('admin-proyek')->with('success', 'Proyek deleted successfully.');
    }

    public function proyekMonitotingAdmin($id)
    {
        $proyek = Proyek::findOrFail($id);
        $data = [
            'title' => 'Monitoring Proyek',
            'description' => 'Halaman Monitoring Proyek',
            'proyek' => $proyek,
            'monitorings' => Monitoring::where('proyek_id', $id)->get(),
            'tahaps' => Tahap::where('proyek_id', $id)->get(),

        ];
        return view('admin.proyek.monitoring-admin', $data);
    }

    public function cekdoc($id)
    {
        $monitoring = Monitoring::findOrFail($id);
        $data = [
            'title' => 'Cek Dokumen Monitoring',
            'description' => 'Halaman Cek Dokumen Monitoring',
            'monitoring' => $monitoring,
            'dokumentsss' => Dokument::where('monitoring_id', $id)->get(),
        ];
        return view('admin.proyek.cek-dokumen', $data);
    }



}
