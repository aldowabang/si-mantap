@extends('layout.main')
@section('content')
    <div class="az-content-label">view detail proyek Tender</div>
    <p class="mg-b-20">Berikut adalah detail proyek yang telah Anda pilih.</p>


    <div class="card mb-5" style="border-radius: 15px;">
        <div class="card-header">
            <div class="row mt-3 mb-3">
                .<div class="col-md-6">
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
                <div class="row mt-3">
                    <div class="col-md-6 d-flex align-items-center">
                        @if ($proyek->file_path)
                            <button type="button" class="btn btn-primary ml-3 mr-2" style="border-radius: 5px" data-toggle="modal" data-target="#pdfModal">
                                Dokumen
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="pdfModalLabel">Dokumen Proyek</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" style="height:80vh;">
                                            <iframe src="{{ asset('storage/' . $proyek->file_path) }}" frameborder="0" width="100%" height="100%"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <p class="text-muted mb-0">Tidak ada file PDF untuk proyek ini.</p>
                        @endif
                    </div>
                    <div class="col-md-6 d-flex align-items-center">
                    
                        @if ($proyek->monitorings && count(value: $proyek->monitorings) > 0)
                            <a href="{{ route('proyek-monitoring-tender', $proyek->id) }}" style="border-radius: 5px" class="btn btn-success">
                                <i class="typcn typcn-eye mr-2"></i>Laporan
                            </a>
                        @else
                        <p class="text-muted mb-0">Tidak ada laporan untuk proyek ini.</p>
                            
                        @endif
                    </div>
                </div>
            </div>
            @if ($proyek->gambar)
                <img src="{{ asset('storage/' . $proyek->gambar) }}" alt="Gambar Proyek" class="img-fluid mt-3">
            @else
                <p class="text-muted">Tidak ada gambar proyek.</p>
            @endif
        </div>
    </div>

@endsection