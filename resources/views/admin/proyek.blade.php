@extends('layout.main')
@section('content')
        <div class="az-content-label mg-b-5">Data Proyek</div>
        <p class="mg-b-20"></p>
        <a href="{{ route('admin-add-proyek') }}" class="btn btn-primary mb-3" style="border-radius: 5px;">
                <i class="typcn typcn-plus"></i> Tambah Proyek
        </a>
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
                                        <p class="card-text"><strong>Created At:</strong> {{ $row->user->name }}</p>
                                        <div class="btn-group" role="group">
                                                        <a href="{{ route('admin-view-proyek', $row->id) }}" class="btn btn-info btn-sm mr-2"  style="border-radius: 5px;"
                                                        style="border-radius: 10px;">
                                                                        <i class="typcn typcn-eye"></i> Lihat
                                                        </a>
                                                        <a href="{{ route('admin-edit-proyek', $row->id) }}" class="btn btn-warning btn-sm mr-2"  style="border-radius: 5px;"
                                                        style="border-radius: 10px;">
                                                                        <i class="typcn typcn-edit"></i> Edit
                                                        </a>
                                                        <form action="{{ route('admin-delete-proyek', $row->id) }}" method="POST" class="form-hapus-proyek" style="display:inline;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger btn-sm"  style="border-radius: 5px;"
                                                        style="border-radius: 10px;">
                                                                                        <i class="typcn typcn-trash"></i> Hapus
                                                                        </button>
                                                        </form>
                                        </div>
                                        </div>

                        </div>

                        
                @endforeach

                </div>
        </div>
@endsection