<?php

namespace App\Http\Controllers;


use App\Models\Tahap;
use App\Models\Proyek;
use App\Models\Dokument;
use App\Models\Monitoring;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class TenderController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Tender',
            'description' => 'Halaman Tender',
        ];
        return view('tender.index', $data);
    }

    public function ProyekTender()
    {
        // Ambil data proyek yang terkait dengan pengawas yang sedang login
        $tenderId = Auth::id(); // Ambil ID pengawas yang sedang login
        $data = Proyek::where('tender_id', $tenderId)->get();
        $data = [
            'title' => 'Proyek Tender',
            'description' => 'Halaman Proyek Tender',
            'data' => $data,
        ];
        return view('tender.proyek.tender', $data);
    }

    public function viewProyekTender($id)
    {
        // Ambil data proyek berdasarkan ID
        $proyek = Proyek::findOrFail($id);

        $data = [
            'title' => 'Detail Proyek Tender',
            'description' => 'Halaman Detail Proyek',
            'proyek' => $proyek,
        ];
        return view('tender.proyek.tender-view-proyek', $data);
    }

    public function proyekMonitotingTender($id)
    {
        $adminUsers = User::where('role', 'admin')->get();
        $proyek = Proyek::findOrFail($id);
        $dokuments = Dokument::where('monitoring_id', $id);
        $data = [
            'title' => 'Monitoring Proyek Tender',
            'description' => 'Halaman Monitoring Proyek Tender',
            'proyek' => $proyek,
            'monitorings' => Monitoring::where('proyek_id', $id)->get(),
            'tahapss' => Tahap::where('proyek_id', $id)->get(),
            'dokuments_count' => $dokuments,

        ];
        return view('tender.proyek.monitoring-tender', $data);
    }

        public function cekDokumenTender($id)
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
            'title' => 'Cek Dokumen Monitoring Tender',
            'description' => 'Halaman Cek Dokumen Monitoring Tender',
            'monitoring' => $monitoring,
            'dokumentsss' => Dokument::where('monitoring_id', $id)->get(),
        ];
        return view('tender.proyek.cek-dokument-tender', $data);
    }

    public function laporanPdfTender($id)
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
            $pdf = Pdf::loadView('tender/pdf', $data);
            return $pdf->download('laporan-tender-' . $fileName . '.pdf');
    }
}
