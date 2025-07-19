<?php

namespace App\Http\Controllers;

use App\Models\Tahap;
use App\Models\Proyek;
use App\Models\Monitoring;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;


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
        ], [
            'nama_monitoring.required' => 'Nama monitoring harus diisi.',
            'nama_monitoring.string' => 'Nama monitoring harus berupa teks.',
            'nama_monitoring.max' => 'Nama monitoring tidak boleh lebih dari 255 karakter.',
            'deskripsi_monitoring.string' => 'Deskripsi monitoring harus berupa teks.',
            'proyek_id.required' => 'Proyek harus dipilih.',
            'proyek_id.exists' => 'Proyek yang dipilih tidak valid.',
            'deskripsi_monitoring.required' => 'Deskripsi monitoring harus diisi.',
        ]);

        // Simpan data ke database (logika penyimpanan belum diimplementasikan)
        // Contoh penyimpanan data monitoring
        $monitoring = new Monitoring();
        $monitoring->nama_monitoring = $request->nama_monitoring;
        $monitoring->deskripsi_monitoring = $request->deskripsi_monitoring;
        $monitoring->proyek_id = $request->proyek_id;
        $monitoring->status_monitoring = 'non-approval'; // Set default status
        $monitoring->tanggal_monitoring = now(); // Set current date as monitoring date
        $monitoring->save();        
        return redirect()->route('proyek-monitoring-pengawas', ['id' => $monitoring->proyek_id])->with('success', 'Monitoring berhasil ditambahkan.');
    }

    public function proyekMonitotingPengawas($id)
    {
        $proyek = Proyek::findOrFail($id);
        $data = [
            'title' => 'Monitoring Proyek',
            'description' => 'Halaman Monitoring Proyek',
            'proyek' => $proyek,
            'monitorings' => Monitoring::where('proyek_id', $id)->get(),
            'tahaps' => Tahap::where('proyek_id', $id)->get(),

        ];
        return view('pengawas.proyek.monitoring-pengawas', $data);
    }


}
