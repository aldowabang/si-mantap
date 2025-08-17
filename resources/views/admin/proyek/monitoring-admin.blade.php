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
                    @foreach($tahaps as $tahap)
                        <div class="mb-4">
                            <div class="btn-icon-list d-flex flex-wrap justify-content-xxl-between mb-2">
                                <button class="btn btn-success btn-sm" type="button" data-toggle="collapse" data-target="#tahap-{{ $tahap->id }}" aria-expanded="false" aria-controls="tahap-{{ $tahap->id }}" style="border-radius: 5px">
                                    {{ $tahap->namaTahap }}
                                </button>
                                <form action="{{ route('konfirmasi-tahap-admin', $tahap->id) }}" method="POST" class="konfirmasi-dokument-admin d-inline m-1">
                                    @csrf
                                    <input type="hidden" name="tahap_id" value="{{ $tahap->id }}">
                                    <input type="hidden" name="whatsapp" value="{{ $pengawas_proyek->whatsapp }}">
                                    @if($tahap->statusTahap === 'non-approval')
                                        <button class="btn btn-warning btn-sm btn-icon" type="submit" style="border-radius: 5px"><i class="typcn typcn-lock-closed"></i></button>
                                    @elseif($tahap->statusTahap === 'approval-pengawas')
                                        <button class="btn btn-info btn-sm btn-icon" type="submit" style="border-radius: 5px"><i class="typcn typcn-lock-closed"></i></button>
                                    @endif
                                </form>
                                @if($tahap->statusTahap === 'approval-pengawas')
                                    <strong class="text-info">{{ $tahap->statusTahap }}</strong>
                                @elseif($tahap->statusTahap === 'non-approval')
                                    <strong class="text-danger">{{ $tahap->statusTahap }}</strong>
                                @endif
                            </div>
                            <div class="collapse" id="tahap-{{ $tahap->id }}">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Monitoring</th>
                                            <th>Deskripsi</th>
                                            <th>File</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $filteredMonitorings = $monitorings->where('tahap_id', $tahap->id);
                                        @endphp
                                        @forelse ($filteredMonitorings as $monitoring)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $monitoring->nama_monitoring }}</td>
                                                <td>{{ $monitoring->deskripsi_monitoring }}</td>
                                                <td>
                                                    <div class="btn-icon-list d-flex flex-wrap justify-content-center">
                                                        <a href="{{ route('cek-doc', $monitoring->id) }}" class="btn btn-indigo btn-icon m-1" style="border-radius: 5px;">
                                                            <i class="typcn typcn-document"></i>
                                                        </a>
                                                        @if($monitoring->status_monitoring === 'non-approval')
                                                            <form action="{{ route('konfirmasi-dokument', $monitoring->id) }}" method="POST" class="form-konfirmasi-dokument m-1">
                                                                @csrf
                                                                <input type="hidden" name="monitoring_id" value="{{ $monitoring->id }}">
                                                                <button type="submit" class="btn btn-success btn-icon" style="border-radius: 5px;">
                                                                    <i class="typcn typcn-tick"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">Tidak ada monitoring pada tahap ini.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection