<?php



namespace App\Http\Controllers;

use App\Models\Tahap;
use App\Models\Proyek;
use App\Models\Dokument;
use App\Models\Monitoring;
use Illuminate\Http\Request;
use App\Models\Monitoringtahap;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PengawasController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::check() && Auth::user()->role !== 'pengawas') {
                return redirect()->back()->with('error', 'Bukan Hak Anda!');
            }
            return $next($request);
        });
    }
    
    public function index()
    {
        $data = [
            'title' => 'Dashboard Pengawas',
            'description' => 'Halaman Pengawas',
        ];
        return view('pengawas.index', $data);
    }

    public function proyekPengawas()
    {
        // Ambil data proyek yang terkait dengan pengawas yang sedang login
        $pengawasId = Auth::id(); // Ambil ID pengawas yang sedang login
        $data = Proyek::where('user_id', $pengawasId)->get();

        $viewData = [
            'title' => 'Proyek Pengawas',
            'description' => 'Halaman Proyek Pengawas',
            'data' => $data,
        ];
        return view('pengawas.proyek.proyek-pengawas', $viewData);
    }

    public function viewProyek($id)
    {
        // Ambil data proyek berdasarkan ID
        $proyek = Proyek::findOrFail($id);

        $data = [
            'title' => 'Detail Proyek',
            'description' => 'Halaman Detail Proyek',
            'proyek' => $proyek,
        ];
        return view('pengawas.proyek.pengawas-view-proyek', $data);
    }

    public function addMonitoring($id)
    {
        // Cek apakah proyek dengan ID tersebut ada
        $proyek = Proyek::findOrFail($id);
        // Siapkan data untuk tampilan
        if (!$proyek) {
            return redirect()->back()->with('error', 'Proyek tidak ditemukan.');
        }   
        // Jika cari tahap yang terkait dengan proyek ini
        $tahaps = Tahap::where('proyek_id', $id)->get();
        $data = [
            'title' => 'Tambah Monitoring',
            'description' => 'Halaman Tambah Monitoring',
            'proyek_id' => $id,
            'tahaps' => $tahaps,
        ];
        return view('pengawas.add-monitoring', $data);
    }

    public function storeMonitoring(Request $request)
    {
        // Validasi dan simpan data monitoring
        $request->validate([
            'nama_monitoring' => 'required|string|max:255',
            'deskripsi_monitoring' => 'required|string',
            'proyek_id' => 'required|exists:proyeks,id',
            'tahap_monitoring' => 'required|exists:tahaps,id',
        ], [
            'nama_monitoring.required' => 'Nama monitoring harus diisi.',
            'nama_monitoring.string' => 'Nama monitoring harus berupa teks.',
            'nama_monitoring.max' => 'Nama monitoring tidak boleh lebih dari 255 karakter.',
            'deskripsi_monitoring.string' => 'Deskripsi monitoring harus berupa teks.',
            'proyek_id.required' => 'Proyek harus dipilih.',
            'proyek_id.exists' => 'Proyek yang dipilih tidak valid.',
            'deskripsi_monitoring.required' => 'Deskripsi monitoring harus diisi.',
            'tahap_monitoring.required' => 'Tahap monitoring harus dipilih.',
            'tahap_monitoring.exists' => 'Tahap monitoring yang dipilih tidak valid.',
        ]);

        // Simpan data ke database (logika penyimpanan belum diimplementasikan)
        // Contoh penyimpanan data monitoring
        $monitoring = new Monitoring();
        $monitoring->nama_monitoring = $request->nama_monitoring;
        $monitoring->deskripsi_monitoring = $request->deskripsi_monitoring;
        $monitoring->proyek_id = $request->proyek_id;
        $monitoring->tahap_id = $request->tahap_monitoring; // Simpan tahap yang dipilih
        $monitoring->status_monitoring = 'non-approval'; // Set default status
        $monitoring->tanggal_monitoring = now(); // Set current date as monitoring date

        $monitoring->save();        
        

        return redirect()->route('proyek-monitoring-pengawas', ['id' => $monitoring->proyek_id])->with('success', 'Monitoring berhasil ditambahkan.');
    }

    public function proyekMonitotingPengawas($id)
    {
        $adminUsers = User::where('role', 'admin')->get();
        $proyek = Proyek::findOrFail($id);
        $dokuments = Dokument::where('monitoring_id', $id);
        $data = [
            'title' => 'Monitoring Proyek',
            'description' => 'Halaman Monitoring Proyek',
            'proyek' => $proyek,
            'monitorings' => Monitoring::where('proyek_id', $id)->get(),
            'tahapss' => Tahap::where('proyek_id', $id)->get(),
            'dokuments_count' => $dokuments,

        ];
        return view('pengawas.proyek.monitoring-pengawas', $data);
    }

    public function cekDokumenPengawas($id)
    {
        // Cek apakah monitoring dengan ID tersebut ada
        $monitoring = Monitoring::findOrFail($id);
        // Siapkan data untuk tampilan
        if (!$monitoring) {
            return redirect()->back()->with('error', 'Monitoring tidak ditemukan.');
        }
        // Ambil dokumen yang terkait dengan monitoring ini
    $monitoring = Monitoring::findOrFail($id);
        $data = [
            'title' => 'Cek Dokumen Monitoring',
            'description' => 'Halaman Cek Dokumen Monitoring',
            'monitoring' => $monitoring,
            'dokumentsss' => Dokument::where('monitoring_id', $id)->get(),
        ];
        return view('pengawas.proyek.cek-dokument-pengawas', $data);
    }

    public function addDokumentPengawas($id)
    {
        // Cek apakah monitoring dengan ID tersebut ada
        $monitoring = Monitoring::findOrFail($id);
        // Siapkan data untuk tampilan
        if (!$monitoring) {
            return redirect()->back()->with('error', 'Monitoring tidak ditemukan.');
        }
        // Siapkan data untuk form tambah dokument
        $tahaps = Tahap::where('proyek_id', $monitoring->proyek_id)->get();
        if ($tahaps->isEmpty()) {
            return redirect()->back()->with('error', 'Tahap tidak ditemukan untuk proyek ini.');
        }
        // Siapkan data untuk tampilan  
        $data = [
            'title' => 'Tambah Dokument Pengawas',
            'description' => 'Halaman Tambah Dokument Pengawas',
            'monitoring' => $monitoring,
            'tahaps' => $tahaps,
        ];
        return view('pengawas.proyek.add-dokument-pengawas', $data);
    }

    public function storeDokumentPengawas(Request $request)
    {
        // Validasi dan simpan data dokument
        $request->validate([
            'namaDokumen' => 'required|string|max:255',
            'file_path_dokument' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'monitoring_id' => 'required|exists:monitorings,id',
            'deskripsi_dokument' => 'required|string',
        ], [
            'namaDokumen.required' => 'Nama dokument harus diisi.',
            'namaDokumen.string' => 'Nama dokument harus berupa teks.',
            'namaDokumen.max' => 'Nama dokument tidak boleh lebih dari 255 karakter.',
            'file_path_dokument.required' => 'File dokument harus diunggah.',
            'file_path_dokument.file' => 'File dokument harus berupa file.',
            'file_path_dokument.mimes' => 'File dokument harus berupa file dengan format pdf, jpg, jpeg, atau png.',
            'file_path_dokument.max' => 'Ukuran file dokument tidak boleh lebih dari 2MB.',
            'monitoring_id.required' => 'Monitoring harus dipilih.',
            'monitoring_id.exists' => 'Monitoring yang dipilih tidak valid.',
            'deskripsi_dokument.required' => 'Deskripsi dokument harus diisi.',
            'deskripsi_dokument.string' => 'Deskripsi dokument harus berupa teks.',
        ]);

        // Simpan data ke database (logika penyimpanan belum diimplementasikan)
        // Contoh penyimpanan data dokument
        $dokument = new Dokument();
        $dokument->namaDokumen = $request->namaDokumen;
        $dokument->monitoring_id = $request->monitoring_id;

        // Simpan file yang diunggah
        if ($request->hasFile('file_path_dokument')) {
            $file = $request->file('file_path_dokument');

            $filename = $file->store('uploads/dokuments', 'public');
            $dokument->file_path_dokument = $filename;
        }
        $dokument->deskripsi_dokument = $request->input('deskripsi_dokument', null);
        $dokument->status_dokument = 'new'; // Set default status
        $dokument->catatan = null; // Set default catatan
        $dokument->save();

        return redirect()->route('cek-dokument-pengawas', ['id' => $dokument->monitoring_id])->with('success', 'Dokument berhasil ditambahkan.');
    }

    public function editDokumentPengawas($id)
    {
        // Cek apakah dokument dengan ID tersebut ada
        $dokument = Dokument::findOrFail($id);
        // Siapkan data untuk tampilan
        if (!$dokument) {
            return redirect()->back()->with('error', 'Dokument tidak ditemukan.');
        }
        // Siapkan data untuk form edit dokument
        $monitoring = Monitoring::findOrFail($dokument->monitoring_id);
        $data = [
            'title' => 'Edit Dokument Pengawas',
            'description' => 'Halaman Edit Dokument Pengawas',
            'dokument' => $dokument,
            'monitoring' => $monitoring,
        ];
        return view('pengawas.proyek.edit-dokument-pengawas', $data);
    }

    public function updateDokumentPengawas(Request $request, $id)
    {
        // Validasi dan update data dokument
        $request->validate([
            'namaDokumen' => 'required|string|max:255',
            'file_path_dokument' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'monitoring_id' => 'required|exists:monitorings,id',
            'deskripsi_dokument' => 'required|string',
        ], [
            'namaDokumen.required' => 'Nama dokument harus diisi.',
            'namaDokumen.string' => 'Nama dokument harus berupa teks.',
            'namaDokumen.max' => 'Nama dokument tidak boleh lebih dari 255 karakter.',
            'file_path_dokument.file' => 'File dokument harus berupa file.',
            'file_path_dokument.mimes' => 'File dokument harus berupa file dengan format pdf, jpg, jpeg, atau png.',
            'file_path_dokument.max' => 'Ukuran file dokument tidak boleh lebih dari 2MB.',
            'monitoring_id.required' => 'Monitoring harus dipilih.',
            'monitoring_id.exists' => 'Monitoring yang dipilih tidak valid.',
            'deskripsi_dokument.required' => 'Deskripsi dokument harus diisi.',
            'deskripsi_dokument.string' => 'Deskripsi dokument harus berupa teks.',
        ]);

        // Temukan dokument berdasarkan ID
        $dokument = Dokument::findOrFail($id);
        $dokument->namaDokumen = $request->namaDokumen;
        $dokument->monitoring_id = $request->monitoring_id;

        // Update file jika ada yang diunggah

        if ($request->hasFile('file_path_dokument')) {
            $file = $request->file('file_path_dokument');
            $filename = $file->store('uploads/dokuments', 'public');
            $dokument->file_path_dokument = $filename;
        }
        $dokument->deskripsi_dokument = $request->input('deskripsi_dokument', null);
        $dokument->status_dokument = 'new'; // Set default status
        $dokument->catatan = null; // Set default catatan
        $dokument->save();

        return redirect()->route('cek-dokument-pengawas', ['id' => $dokument->monitoring_id])->with('success', 'Dokument berhasil diperbarui.');
    }

    public function deleteDokumentPengawas($id)
    {
        // Cek apakah dokument dengan ID tersebut ada
        $dokument = Dokument::findOrFail($id);
        // Hapus dokument
        $dokument->delete();
        return redirect()->back()->with('success', 'Dokument berhasil dihapus.');
    }

    public function konfirmasiDokument(Request $request, $id)
    {
        $request->validate([
            'monitoring_id' => 'required|exists:monitorings,id',
        ], [
            'monitoring_id.required' => 'Monitoring harus dipilih.',
            'monitoring_id.exists' => 'Monitoring yang dipilih tidak valid.',
        ]);
        // Cek apakah ada dokument terkait dengan monitoring_id
        $dokumentCount = Dokument::where('monitoring_id', $id)->count();
        if ($dokumentCount === 0) {
            return redirect()->back()->with('error', 'Tidak ada dokument untuk monitoring ini.');
        }elseif ($dokumentCount < 5){
            return redirect()->back()->with('error', 'Jumlah dokument harus lebih dari 5 untuk konfirmasi.');
        }

        if ($dokumentCount > 4) {
            Dokument::where('monitoring_id', $id)->update(['status_dokument' => 'pending']);
        }
        // Temukan dokument berdasarkan ID
        // Update semua dokument yang terkait dengan monitoring_id menjadi 'pending'
        
        // Temukan monitoring berdasarkan ID
        $monitoring = Monitoring::findOrFail($id);
        // Update status monitoring menjadi 'approval-pengawas'
        $monitoring->status_monitoring = 'approval-pengawas';
        $monitoring->save();
        return redirect()->route('cek-dokument-pengawas', ['id' => $monitoring->id])->with('success', 'Dokument berhasil dikonfirmasi.');
    }

    public function konfirmasiTahapPengawas(Request $request, $id)
        {
            $request->validate([
                'tahap_id' => 'exists:tahaps,id',
            ]);

            // 1. Ambil monitoring
            $monitoring = Monitoring::find($id);
            if (!$monitoring) {
                return redirect()->back()->with('error', 'Monitoring tidak ditemukan.');
            }

            // 2. Cek semua dokumen terkait monitoring
            $totalDokumen = Dokument::where('monitoring_id', $id)->count();
            $approvedDokumen = Dokument::where('monitoring_id', $id)
                                        ->where('status_dokument', 'approved')
                                        ->count();

            if ($totalDokumen < 5) {
                return redirect()->back()->with('error', 'Jumlah dokumen harus lebih dari 5 untuk konfirmasi tahap.');
            }

            if ($approvedDokumen < $totalDokumen) {
                return redirect()->back()->with('error', 'Semua dokumen harus berstatus approved untuk konfirmasi tahap.');
            }

            // 3. Cek status monitoring
            if ($monitoring->status_monitoring !== 'approval-pengawas') {
                return redirect()->back()->with('error', 'Monitoring harus berstatus approval-pengawas untuk konfirmasi tahap.');
            }

            // 4. Ambil tahap
            $tahap = Tahap::find($request->tahap_id);
            if (!$tahap) {
                return redirect()->back()->with('error', 'Tahap tidak ditemukan.');
            }

            // 5. Update status tahap
            $tahap->statusTahap = 'approval-pengawas';
            $tahap->save();

            // 6. Kirim WA ke admin
            $message = "Hallo Admin,\n" .
                "Tahap proyek telah dikonfirmasi oleh pengawas.\n\n" .
                "ID Tahap: {$tahap->id}\n" .
                "Nama Tahap: {$tahap->namaTahap}\n" .
                "Proyek ID: {$tahap->proyek_id}\n" .
                "Status Tahap: {$tahap->statusTahap}\n\n" .
                "Silakan cek tahap tersebut di sistem.";

            $this->kirimWaKeAdmin($message);

            return redirect()->back()->with('success', 'Tahap berhasil dikonfirmasi.');
        }


    // public function konfirmasiTahapPengawas(Request $request, $id)
    //     {
    //         $request->validate([
    //             'tahap_id' => 'exists:tahaps,id',
    //         ]);
    //         // Cek apakah ada dokument terkait dengan monitoring_id
    //         $monitoring = Monitoring::findOrFail($id);
    //         $totalMonitoring = Monitoring::where('id', $id)->count();

    //         // ambli monitoring yang berstatus approval-pengawas
    //         $approvePengawas = Monitoring::where('id', $id)->where('status_monitoring', 'approval-pengawas')->count();

    //         if (!$monitoring) {
    //             return redirect()->back()->with('error', 'Monitoring tidak ditemukan.');
    //         }

    //         // Ambil jumlah semua dokument terkait monitoring_id
    //         $totalDokumen = Dokument::where('monitoring_id', $id)->count();

    //         // Ambil jumlah dokument yang sudah approved
    //         $approvedDokumen = Dokument::where('monitoring_id', $id)
    //                                     ->where('status_dokument', 'approved')
    //                                     ->count();
    //         // monitoring hatus lebih dari 5
    //         if($totalMonitoring < 5){
    //             return redirect()->back()->with('error', 'Jumlah dokument harus lebih dari 5 untuk konfirmasi tahap.');
    //         }elseif ($approvePengawas > 4) {
    //             return redirect()->back()->with('error', 'Monitoring harus berstatus approval-pengawas untuk konfirmasi tahap.');
    //         }else{
    //             // Jika monitoring sudah berstatus approval-pengawas, lanjutkan
    //         }

            

    //         // Jika ada yang belum approved
    //         if ($approvedDokumen < $totalDokumen) {
    //             return redirect()->back()->with('error', 'Semua dokument harus berstatus approval untuk konfirmasi tahap.');
    //         }

    //         // Cek apakah tahap dengan ID tersebut ada
    //         $tahap = Tahap::findOrFail($id);

    //         // Update status tahap
    //         $tahap->statusTahap = 'approval-pengawas';
    //         // krim wa ke admin
    //         $massage = "Hallo Admin, \n" .
    //             "Tahap proyek telah dikonfirmasi oleh pengawas.\n\n" .
    //             "ID Tahap: {$tahap->id}\n" .
    //             "Nama Tahap: {$tahap->namaTahap}.\n" .
    //             "Proyek ID: {$tahap->proyek_id}.\n" .
    //             "Status Tahap: {$tahap->statusTahap}.\n\n" .
    //             "Silakan cek tahap tersebut di sistem.";
    //         $this->kirimWaKeAdmin($massage);

    //         $tahap->save();


    //         return redirect()->back()->with('success', 'Tahap berhasil dikonfirmasi.');
    //     }


    public function kirimWaKeAdmin($message)
    {
        // Ambil semua user dengan role 'admin'
        $admins = User::where('role', 'admin')->get();

        $apiKey = env('FONNTE_API_KEY');

        foreach ($admins as $admin) {
            // Pastikan nomor WA tidak kosong
            if ($admin->whatsapp) {
                $response = Http::withHeaders([
                    'Authorization' => $apiKey,
                    'Content-Type' => 'application/json',
        ])->post('https://api.fonnte.com/send', [
            'target' => $admin->whatsapp,  
            'message' => $message,
            'countryCode' => "62",
        ]);
            }
        }
    }



    public function editDokumentPengawasRev(Request $request, $id)
    {
        // Validasi dan update data dokument
        $request->validate([
            'deskripsi_dokument' => 'required|string|max:255',
            'file_path_dokument' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'catatan' => 'nullable|string|max:500',
        ], [
            'deskripsi_dokument.string' => 'Deskripsi dokument harus berupa teks.',
            'deskripsi_dokument.max' => 'Deskripsi dokument tidak boleh lebih dari 255 karakter.',
            
        ]);

        // Temukan dokument berdasarkan ID
        $dokument = Dokument::findOrFail($id);
        $dokument->deskripsi_dokument = $request->deskripsi_dokument;

        // Update file jika ada yang diunggah
        if ($request->hasFile('file_path_dokument')) {
            $file = $request->file('file_path_dokument');
            $filename = $file->store('uploads/dokuments', 'public');
            $dokument->file_path_dokument = $filename;
        }
        
        // Set status dokument ke 'revisi'
        $dokument->status_dokument = 'pending';
        $dokument->catatan = $request->input('catatan', null); // Set catatan jika ada
        $dokument->save();

        return redirect()->route('cek-dokument-pengawas', ['id' => $dokument->monitoring_id])->with('success', 'Dokument berhasil diperbarui.');
    }

    public function addTahap($id)
    {
        // cari nomer wa admin
        $pengawas = User::where('role', 'admin')->first();
        if (!$pengawas) {
            return redirect()->back()->with('error', 'Admin tidak ditemukan.');
        }
        // Cek apakah proyek dengan ID tersebut ada
        $proyek = Proyek::findOrFail($id);
        // Siapkan data untuk tampilan
        $tahapBelumApproved = Tahap::where('proyek_id', $id)
        ->where('statusTahap', '!=', 'approval-admin')
        ->exists();

    if ($tahapBelumApproved) {
        return redirect()->back()->with('error', 'Tidak dapat menambahkan tahap baru karena masih ada tahap yang belum disetujui admin.');
    }
        // Siapkan data untuk form tambah tahap
        $data = [
            'title' => 'Tambah Tahap',
            'description' => 'Halaman Tambah Tahap',
            'proyek_id' => $proyek,
            'pengawas' => $pengawas, // Ambil nomor WhatsApp admin
        ];
        return view('pengawas.proyek.add-tahap', $data);
    }

    public function storeTahap(Request $request)
    {
        // Validasi dan simpan data tahap
        $request->validate([
            'namaTahap' => 'required|string|max:255',
            'proyek_id' => 'required|exists:proyeks,id',
            'wa' => 'required|string|max:15',
        ], [
            'namaTahap.required' => 'Nama tahap harus diisi.',
            'namaTahap.string' => 'Nama tahap harus berupa teks.',
            'namaTahap.max' => 'Nama tahap tidak boleh lebih dari 255 karakter.',
            'proyek_id.required' => 'Proyek harus dipilih.',
            'proyek_id.exists' => 'Proyek yang dipilih tidak valid.',
        ]);

        // Simpan data ke database (logika penyimpanan belum diimplementasikan)
        // Contoh penyimpanan data tahap
        $tahap = new Tahap();
        $tahap->namaTahap = $request->namaTahap;
        $tahap->proyek_id = $request->proyek_id;
        $tahap->statusTahap = 'non-approval'; // Set default status
        $tahap->save();
        // Ambil nomor WhatsApp dari request
        $wa = $request->input('wa');

        // Kirim notifikasi WhatsApp ke admin
        
        $this->sendWhatsAppNotificationTahapAdmin($tahap, $wa);

        return redirect()->route('pengawas-proyek')->with('success', 'Tahap berhasil ditambahkan.');
    }

    public function sendWhatsAppNotificationTahapAdmin($tahap, $wa)
    {
        $apiKey = env('FONNTE_API_KEY');
        $message = "Hallo Admin, \n" .
            "Tahap proyek telah dikonfirmasi oleh pengawas.\n\n" .
            "ID Tahap: {$tahap->id}\n" .
            "Nama Tahap: {$tahap->namaTahap}.\n" .
            "Proyek ID: {$tahap->proyek_id}.\n" .
            "Status Tahap: {$tahap->statusTahap}.\n\n" .
            "Silakan cek tahap tersebut di sistem.";

        Http::withHeaders([
            'Authorization' => $apiKey,
            'Content-Type' => 'application/json',
        ])->post('https://api.fonnte.com/send', [
            'target' => $wa,
            'message' => $message,
            'countryCode' => "62",
        ]);
    }

    public function laporanPdfPengawas($id)
    {
            $fileName = now()->format('Y-m-d_H-i-s');
            // Ambil data yang diperlukan untuk laporan
            $data = [
                'proyek' => Proyek::findOrFail($id),
                'monitorings' => Monitoring::where('proyek_id', $id)->get(),
                'tahaps' => Tahap::where('proyek_id', $id)->get(),
                'dokuments' => Dokument::where('monitoring_id', $id)->get(),
                'pengawas' => Auth::user(), // Ambil data pengawas yang sedang login
            ];
            // Generate PDF
            $pdf = Pdf::loadView('pengawas/pdf', $data);
            return $pdf->download('laporan-pengawas-' . $fileName . '.pdf');
    }

    

}
