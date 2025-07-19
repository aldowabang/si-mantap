@extends('layout.main')
@section('content')
    <div class="az-content-label">Monitoring Proyek</div>
    <p class="mg-b-20">Berikut adalah daftar monitoring proyek yang telah Anda pilih.</p>
    <div class="card" style="border-radius: 15px;">
        <div class="card-header">
            <div class="row mt-3 mb-3">
                <div class="col-md-6">
                    <h5 class="card-title">{{ $proyek->nameProyek }}</h5>
                </div>      
                <div class="col-md-6 mb-2">
                    <p class="mb-1"><strong>Lokasi:</strong> {{ $proyek->lokasi }}</p>
                    <p class="mb-1"><strong>Anggaran:</strong> Rp {{ number_format($proyek->nilai, 0, ',', '.') }}</p>
                </div>
                <div class="col-md-6 mb-2">
                    <p class="mb-1"><strong>Status:</strong> {{ $proyek->status }}</p>
                    <p class="mb-1"><strong>Deskripsi:</strong> {{ $proyek->deskripsi }}</p>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-12">
                    <table class="table table-bordered">        
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Deskripsi</th>
                                <th>File</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($monitorings as $monitoring)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $monitoring->nama_monitoring }}</td>
                                    <td>{{ $monitoring->deskripsi_monitoring }}</td>
                                    <td>
                                        <a href="{{ route('cek-doc', $monitoring->id) }}" class="btn btn-indigo btn-icon m-1" style="border-radius: 5px;">
                                            <i class="typcn typcn-document"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection