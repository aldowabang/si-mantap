{{-- resources/views/pengawas/pdf.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pengawas</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12px;
        }
        h2, h3, h4 {
            margin: 5px 0;
        }
        .header {
            text-align: center;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }
        table, th, td {
            border: 1px solid #333;
        }
        th, td {
            padding: 6px;
            text-align: left;
        }
        .section-title {
            background: #eee;
            padding: 4px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    {{-- HEADER --}}
    <div class="header">
        <h2>LAPORAN PENGAWAS PROYEK</h2>
        <p>{{ now()->translatedFormat('d F Y') }}</p>
    </div>

    {{-- INFORMASI PROYEK --}}
    <p><strong>Nama Proyek:</strong> {{ $proyek->nameProyek ?? '-' }}</p>
    <p><strong>Lokasi:</strong> {{ $proyek->lokasi ?? '-' }}</p>
    <p><strong>Pengawas:</strong> {{ $pengawas->name ?? '-' }}</p>

    {{-- LOOP TAHAP --}}
    @forelse ($proyek->tahaps as $iTahap => $tahap)
        <h3 class="section-title">Tahap {{ $iTahap + 1 }}: {{ $tahap->namaTahap ?? '-' }}</h3>
        <p>Status: {{ ucfirst($tahap->statusTahap ?? '-') }}</p>

        {{-- LOOP MONITORING DI DALAM TAHAP --}}
        @forelse ($tahap->monitorings as $iMon => $mon)
            <h4>Monitoring {{ $iMon + 1 }}</h4>
            <table>
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $mon->created_at?->format('d-m-Y') ?? '-' }}</td>
                        <td>{{ $mon->deskripsi_monitoring ?? '-' }}</td>
                    </tr>
                </tbody>
            </table>

            {{-- LOOP DOKUMEN DI DALAM MONITORING --}}
            <h4>Dokumen</h4>
       <table>
    <thead>
        <tr>
            <th>No</th>
            <th>Gambar</th>
            <th>Nama Dokumen</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($mon->dokuments as $iDoc => $doc)
            <tr>
                <td style="text-align: center;">{{ $iDoc + 1 }}</td>
                <td style="text-align: center;">
                    @if($doc->file_path_dokument && file_exists(public_path('storage/' . $doc->file_path_dokument)))
                        <img src="{{ public_path('storage/' . $doc->file_path_dokument) }}" 
                             alt="Foto Monitoring" 
                             style="width: 80px; height: 80px; object-fit: cover; border: 1px solid #ccc; padding: 2px;">
                    @else
                        <span style="color: #888;">-</span>
                    @endif
                </td>
                <td>{{ $doc->namaDokumen ?? '-' }}</td>
                <td>{{ ucfirst($doc->status_dokument ?? '-') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" style="text-align:center;">Tidak ada dokumen</td>
            </tr>
        @endforelse
    </tbody>
</table>


        @empty
            <p><em>Tidak ada monitoring</em></p>
        @endforelse

    @empty
        <p><em>Tidak ada tahap</em></p>
    @endforelse

</body>
</html>
