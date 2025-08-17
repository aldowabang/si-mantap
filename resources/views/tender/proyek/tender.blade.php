@extends('layout.main')
@section('content')
    <div class="az-content-label mg-b-5">Data Proyek</div>
        <p class="mg-b-20">Berikut adalah daftar proyek yang anda awasi.</p>
        <p class="mg-b-20"></p>
        <div class="az-conent-body">
            <div class="row">
                @foreach($data as $row)
                        <div class="col-lg-4 col-md-6">
                            <div class="card card-body mb-4 shadow" style="border-radius: 15px;">
                                <img src="{{ asset('storage/' . $row->gambar) }}" class="card-img-top" alt="{{ $row->nama_proyek }}" style="height: 200px; object-fit: cover; border-radius: 5px 5px 0 0;">
                                <h5 class="card-title">{{ $row->nama_proyek }}</h5>
                                <p class="card-text">{{ $row->deskripsi }}</p>
                                <p class="card-text"><strong>Lokasi:</strong> {{ $row->lokasi }}</p>
                                <p class="card-text"><strong>Anggaran:</strong> Rp. {{ number_format($row->nilai, 0, ',', '.') }}</p>
                                <p class="card-text"><strong>Status:</strong> 
                                @if($row->status == 'active')
                                    <span class="badge badge-success">Aktif</span>
                                @else
                                    <span class="badge badge-danger">Tidak Aktif</span>
                                @endif
                                </p>
                                <p class="card-text"><strong>Nama Pengawas:</strong> {{ $row->user->name }}</p>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('tender-view-proyek', $row->id) }}" class="btn btn-info btn-sm mr-2" style="border-radius: 5px;">
                                    <i class="typcn typcn-eye"></i> Lihat</a>
                                </div>
                            </div>
                        </div>
                @endforeach
            </div>
        </div>
@endsection